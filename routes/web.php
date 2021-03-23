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

//Products
Route::any('/products', function () {
    return view('products');
});

//RegisterEmp
Route::any('/emp', function () {
    return view('registerEmp');
});

Route::any('/login', function () {
    return view('login');
});
//Contact Us
Route::any('/contact', function () {
    return view('contact');
});

//FAQ
Route::any('/faq', function () {
    return view('faq');
});


/* Pages that only employees can see */
//Add Products
Route::any('/add', function () {
    return view('add');
});

//Update Products
Route::any('/update', function () {
    return view('update');
});


/* Secret pages */
//Button
Route::any('/button', function () {
    return view('button');
});

//Products (Hardcoded)
Route::any('/HProducts', function () {
    return view('HProducts');
});
