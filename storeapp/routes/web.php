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

//Route::get('category/{slug}', 'Frontend\CategoryController@index')->name('category');

Route::get('/', function () {
    return view('backend/layouts/dashboard');
})->name('dashboard');

Route::get('/content', function () {
    return view('backend/template');
})->name('template');