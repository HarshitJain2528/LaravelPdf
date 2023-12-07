<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewController extends Controller
{
     /**
     * Display the login view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('login');
    }

    /**
     * Display the image upload view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function image()
    {
        return view('ImageUpload');
    }

     /**
     * Display the CSV upload view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function csv()
    {
        return view('CsvUpload');
    }

    /**
     * Display the password change view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function passwordChange()
    {
        return view('PasswordChange');
    }
}
