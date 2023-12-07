<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ViewController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// View related routes
Route::controller(ViewController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/csv', 'csv');
    Route::get('/image', 'image');
    Route::get('/passwordChange','passwordChange');
});

// Login related routes
Route::controller(LoginController::class)->group(function () {
    Route::post('/login','login')->name('login');
    Route::get('/logout', 'logout')->name('logout');
    Route::post('/change-password', 'changePassword')->name('change.password');
});

//ProductController route
Route::post('/uploadImage', [ProductController::class, 'uploadImage'])->name('upload.image');

//PdfController route
Route::post('/uploadCsv', [PdfController::class, 'uploadCsv'])->name('upload.csv');

//ImageController route
Route::post('/downloadImages', [ImageController::class, 'downloadImages'])->name('download.images');