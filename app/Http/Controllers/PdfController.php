<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use TCPDF;

class PdfController extends Controller
{
    public function uploadCsv(Request $request) {
        // Retrieve the uploaded CSV file
        $file = $request->file('csv_file');
        $csvData = array_map('str_getcsv', file($file));
        $columns = array_shift($csvData); // Extract columns

        // Determine which checkboxes are selected
        $selectedColumns = [];
        if ($request->has('sku')) {
            $selectedColumns['sku'] = true;
        }
        if ($request->has('qty')) {
            $selectedColumns['qty'] = true;
        }
        if ($request->has('orderId')) {
            $selectedColumns['orderId'] = true;
        }
        if ($request->has('orderNotes')) {
            $selectedColumns['orderNotes'] = true;
        }
        if ($request->has('invoiceNumber')) {
            $selectedColumns['invoiceNumber'] = true;
        }

        $selectedData = [];
        $images = [];

        // Match CSV Data to selected columns
        foreach ($csvData as $data) {
            $selectedRow = [];

            // Extract SKU based on the 'SKU' column
            $skuColumn = array_search('SKU', $columns);
            $sku = $data[$skuColumn];
            
            // Match images from the database based on the SKU or any unique identifier from CSV
            $product = Product::where('sku_code', $sku)->first();

            // Get the image URL from the database
            if ($product && $product->image) {
                $images[] = $product->image;
            }

            foreach ($selectedColumns as $columnName => $isSelected) {
                if ($isSelected) {
                    $selectedRow[$columnName] = $data[array_search($columnName, $columns)];
                }
            }

            $selectedData[] = $selectedRow;
        }

        // Generate PDF using TCPDF
        $pdf = new TCPDF();
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // Add content to PDF
        foreach ($selectedData as $key => $row) {
            $pdf->AddPage();
            if (isset($images[$key])) {
                $pdf->Image($images[$key], 15, 15, 180, 180); // Display image
            }

            $yPosition = 210;
            foreach ($row as $columnName => $value) {
                $pdf->Text(20, $yPosition, "$columnName: $value");
                $yPosition += 10; // Increment y position for the next line
            }
        }

        // Output the PDF
        $pdf->Output('data_with_images.pdf', 'I'); // 'D' for download
    }
}
