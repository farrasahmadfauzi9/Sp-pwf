<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//panggil ProductController sebagai object
use App\Http\Controllers\ProductController;

//Buat route untuk menambahkan data produk
Route::post('/product',[ProductController::class,'store']);
