<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use TCPDF;

class PdfController extends Controller
{
    public function uploadCsv(Request $request)
    {
        if ($request->hasFile('csv_file')) {
            $file = $request->file('csv_file');
            $data = array_map('str_getcsv', file($file));

            $pdf = new TCPDF();
            $pdf->SetMargins(15, 15, 15);
            $pdf->AddPage();

            foreach ($data as $row) {
                if (isset($row['SKU'])) {
                    $skuCode = $row['SKU'];

                    $product = Product::where('sku_code', $skuCode)->first();

                    if ($product) {
                        $imagePath = $this->getBase64Image($product->image);

                        // Add base64 encoded image to the PDF
                        if ($imagePath) {
                            $pdf->Image('@' . $imagePath, 15, $pdf->GetY(), 60, 60, 'JPG', '', '', true, 150, '', false, false, 1, false, false, false);
                            $pdf->Ln(70); // Move down after adding the image
                        }

                        // Add checkbox values to PDF
                        $checkboxValues = [];
                        if (isset($row['Qty']) && $row['Qty'] != '') {
                            $checkboxValues[] = 'Qty: ' . $row['Qty'];
                        }
                        // Add other checkbox values in a similar manner

                        foreach ($checkboxValues as $checkbox) {
                            $pdf->MultiCell(0, 10, $checkbox, 0, 'L');
                        }
                    }
                }
            }

            // Output the PDF
            $pdf->Output('generated_pdf.pdf', 'I');

            // Redirect back with success message
            return redirect()->back()->with('success', 'PDF generated successfully!');
        }
    }

    // Function to convert online image to base64
    private function getBase64Image($imageUrl)
    {
        $imageContent = file_get_contents($imageUrl);
        $base64 = 'data:image/jpeg;base64,' . base64_encode($imageContent);

        return $base64;
    }
}

