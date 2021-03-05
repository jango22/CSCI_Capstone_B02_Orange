<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Default Routes
|--------------------------------------------------------------------------
|
| These were included in the base Laravel project. No need to touch these.
|
*/
Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/info', function () {
    return view('info');
});
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

/* Pages that users can see */
//Homepage
Route::any('/', function () {
    return view('home');
});
//FAQ
Route::any('/FAQ', function () {
    return view('FAQ');
});
//Contact Us
Route::any('/Contact', function () {
    return view('ContUs');
});
//Products (Hardcoded)
Route::any('/HProducts', function () {
    return view('HProducts');
});


/* Pages that only employees can see */
//Add Products
Route::any('/add', function () {
    return view('add');
});
Route::any('/update', function () {
    return view('update');
});


/* Secret pages */
//Button
Route::any('/button', function () {
    return view('button');
});
