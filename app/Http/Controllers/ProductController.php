<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
     /**
     * Upload CSV file containing product data with SKU codes and image URLs.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('images') && $request->file('images')->isValid()) {
            $file = $request->file('images');

            $data = array_map('str_getcsv', file($file));
    
            $header = array_shift($data);
    
            try {
                Product::truncate();
                foreach ($data as $row) {
                    $product = new Product();
                    $product->sku_code = $row[0]; 
                    $product->image = $row[1];    
                    $product->save();
                }
    
                return redirect()->back()->with('success', 'CSV data imported successfully.');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Error importing CSV data.');
            }
        }
    
        return redirect()->back()->with('error', 'Invalid file uploaded.');
    }
}
