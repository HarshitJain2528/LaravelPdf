<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use TCPDF;

class PdfController extends Controller
{
     /**
     * Upload a CSV file and generate a PDF with data and images.
     *
     * @param  Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function uploadCsv(Request $request)
    {
        $file = $request->file('csv_file');
        $csvData = array_map('str_getcsv', file($file));
        $columns = array_shift($csvData);

        $skus = [];
        $images = [];

        foreach ($csvData as $data) {
            $skuColumn = array_search('SKU', $columns);
            $sku = $data[$skuColumn];
            $skus[] = $sku;

            $product = Product::where('sku_code', $sku)->first();

            if ($product && $product->image) {
                $images[] = $product->image; 
            } else {
                $images[] = null;
            }
        }

        $pdf = new TCPDF();
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        foreach ($images as $index => $image) {
            $pdf->AddPage();
            $pdf->SetFont('helvetica', '', 12);
            
            $pdf->Cell(10, 10, 'SKU: ' . $skus[$index], 0, 1);

            if ($image !== null) {
                $pdf->Image($image, 15, $pdf->GetY() + 30, 180, 180);
            } else {
                $pdf->Cell(0, 10, 'No image available', 0, 1);
            }
        }

        $pdf->Output('data_with_images.pdf', 'I'); 
    }
}
