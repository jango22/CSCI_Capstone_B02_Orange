<?php

use Illuminate\Support\Facades\Route;

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


Route::any('/', function () {
    return view('home');
});
Route::any('/button', function () {
    return view('button');
});
Route::any('/add', function () {
    return view('add');
});
Route::any('/HProducts', function () {
    return view('HProducts');
});


Route::any('/FAQ', function () {
    return view('FAQ');
});


//default PHP routes
Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/info', function () {
    return view('info');
});
