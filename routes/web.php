<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    // $books = json_decode(Http::get('http://127.0.0.1:8000/api/v1/books')->body());
    dd($books);
});


// Route::get('/', function () {
//     $books = json_decode(Http::get('http://127.0.0.1:8000/api/v1/books')->body());
//     dd($books);
//     dd('yes');
// });

