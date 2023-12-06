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

Route::get('/', [ViewController::class,'index'])->name('index');
Route::post('/login', [LoginController::class,'login'])->name('login');
Route::get('/csv', [ViewController::class, 'csv']);
Route::get('/image', [ViewController::class, 'image']);
Route::post('/uploadImage', [ProductController::class, 'uploadImage'])->name('upload.image');
Route::post('/uploadCsv', [PdfController::class, 'uploadCsv'])->name('upload.csv');
Route::post('/downloadImages', [ImageController::class, 'downloadImages'])->name('download.images');
Route::get('/passwordChange', [ViewController::class,'passwordChange']);
Route::get('/logout', [LoginController::class,'logout'])->name('logout');
Route::post('/change-password', [LoginController::class,'changePassword'])->name('change.password');