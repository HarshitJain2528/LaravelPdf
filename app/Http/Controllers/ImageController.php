<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use App\Models\Product;

class ImageController extends Controller
{

    public function downloadImages(Request $request)
    {
        // Assuming you have uploaded the CSV file
        $uploadedFile = $request->file('csv_file');
    
        // Process the CSV file to get SKUs
        $skus = []; // Extracted SKUs from the CSV
    
        // Query database for images related to SKUs
        $images = Product::whereIn('sku_code', $skus)->get(); // Assuming Product is your model for the 'products' table
    
        // Create a ZIP file in memory
        $zipFileName = 'images_' . time() . '.zip';
        $zip = new ZipArchive;
        $zip->open($zipFileName, ZipArchive::CREATE | ZipArchive::OVERWRITE);
    
        // Download images and add to the in-memory ZIP file
        foreach ($images as $image) {
            $imageUrl = $image->image; // Replace with your image column name
            $contents = file_get_contents(public_path($imageUrl)); // Assuming images are stored in public folder
            $imageName = basename($imageUrl);
            $zip->addFromString($imageName, $contents);
        }
    
        $zip->close();
    
        // Clear output buffer to avoid conflicts with Laravel's response
        ob_clean();
    
        // Set headers to force download the ZIP file
        return response()->download($zipFileName, $zipFileName, ['Content-Type' => 'application/zip'])
            ->deleteFileAfterSend(true);
    }
    

}
