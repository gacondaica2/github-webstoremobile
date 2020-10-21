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

Route::get('/', 'Frontend\HomeController@index')->name('home');
Route::get('/danh-muc/{slug}', 'Frontend\CategoryController@index')->name('category');
Route::get('/danh-muc/api/{slug}', 'Frontend\CategoryController@create')->name('category2');
Route::get('/danh-muc/item/{slug}', 'Frontend\ProductController@index')->name('detailItem');
Route::get('/signin', 'Frontend\UserController@index')->name('login');
Route::post('/signin', 'Frontend\UserController@store')->name('login');
Route::post('/register', 'Frontend\UserController@create')->name('register');
Route::get('/home/user', 'Frontend\UserController@show')->name('my_account');
Route::get('/home/user/logout', 'Frontend\UserController@logout')->name('logout');

