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

/*
|--------------------------------------------------------------------------
Pages that anyone can see
|--------------------------------------------------------------------------
*/
//Homepage
Route::any('/', function () {
    return view('home');
});

//Products
Route::any('/products', function () {
    return view('products');
});

//Contact Us
Route::any('/contact', function () {
    return view('contact');
});

//FAQ
Route::any('/faq', function () {
    return view('faq');
});

//Login
Route::any('/login', function () {
    return view('login');
});

//Register User
Route::any('/register', function () {
    return view('registerUser');
});

//test for new product page
Route::any('/newproducts', function () {
    return view('newProducts');
});

/*
|--------------------------------------------------------------------------
Pages that any logged in user can see
|--------------------------------------------------------------------------
*/
//Logout
Route::any('/logout', function () {
    return view('logout');
});

//Cart
Route::any('/cart', function () {
    return view('cart');
});


/*
|--------------------------------------------------------------------------
Pages that only employees can see
|--------------------------------------------------------------------------
*/
//Add Products
Route::any('/add', function () {
    return view('add');
});

//Update Products
Route::any('/update', function () {
    return view('update');
});

//Register Employee
Route::any('/registeremployee', function () {
    return view('registerEmp');
});


/*
|--------------------------------------------------------------------------
Secret Pages
|--------------------------------------------------------------------------
*/
//Button
Route::any('/button', function () {
    return view('button');
});

//Products (Hardcoded)
Route::any('/HProducts', function () {
    return view('HProducts');
});
