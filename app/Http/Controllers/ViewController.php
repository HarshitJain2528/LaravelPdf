<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function image()
    {
        return view('ImageUpload');
    }

    public function csv()
    {
        return view('CsvUpload');
    }

    public function passwordChange()
    {
        return view('PasswordChange');
    }
}
