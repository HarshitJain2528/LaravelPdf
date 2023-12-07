<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use ZipArchive;

class ImageController extends Controller
{
    /**
     * Download images based on provided SKU codes in a CSV file.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function downloadImages(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt'
        ]);

        $csvFile = $request->file('csv_file');

        $skuCodes = [];
        $firstRowSkipped = false;

        if (($handle = fopen($csvFile->getPathname(), 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                if (!$firstRowSkipped) {
                    $firstRowSkipped = true;
                    continue;
                }
                $skuCodes[] = $data[0];
            }
            fclose($handle);
        }

        $imageUrls = Product::whereIn('sku_code', $skuCodes)
            ->pluck('image');

        $tempDirectory = sys_get_temp_dir() . '/downloaded_images';
        if (!is_dir($tempDirectory)) {
            mkdir($tempDirectory);
        }

        foreach ($imageUrls as $imageUrl) {
            $imageContent = file_get_contents($imageUrl);
            $imageName = basename($imageUrl);
            $imagePath = $tempDirectory . '/' . $imageName;
            file_put_contents($imagePath, $imageContent);
        }

        $zip = new ZipArchive;
        $zipFileName = 'images.zip';
        if ($zip->open($zipFileName, ZipArchive::CREATE) === TRUE) {
            foreach (glob($tempDirectory . '/*') as $downloadedFile) {
                $zip->addFile($downloadedFile, basename($downloadedFile));
            }
            $zip->close();

            array_map('unlink', glob($tempDirectory . '/*'));
            rmdir($tempDirectory);

            return response()->download($zipFileName)->deleteFileAfterSend(true);
        }

        return back()->with('error', 'Unable to create zip file');
    }
}