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
//fontend
Route::get('/', 'Frontend\HomeController@index')->name('home');
Route::get('/danh-muc/{slug}', 'Frontend\CategoryController@index')->name('category');
Route::get('/danh-muc/api/{slug}', 'Frontend\CategoryController@create')->name('category2');
Route::get('/danh-muc/item/{slug}', 'Frontend\ProductController@index')->name('detailItem');
Route::get('/signin', 'Frontend\UserController@index')->name('login');
Route::post('/signin', 'Frontend\UserController@store')->name('login');
Route::post('/register', 'Frontend\UserController@create')->name('register');
Route::get('/home/user', 'Frontend\UserController@show')->name('my_account');
Route::get('/home/user/logout', 'Frontend\UserController@logout')->name('logout');
Route::get('home/danh-muc/cart/add/{slug}', 'Frontend\CartController@add')->name('addTocart');
Route::get('home/danh-muc/cart/delete/{id}', 'Frontend\CartController@delete')->name('delete_item_cart');
Route::get('home/danh-muc/cart/detail', 'Frontend\CartController@detail')->name('detail_cart');
Route::post('home/danh-muc/cart/update', 'Frontend\CartController@update')->name('update_cart');
Route::get('home/danh-muc/cart/plus/{id}', 'Frontend\CartController@plus')->name('plus_cart');
Route::get('home/danh-muc/cart/mines/{id}', 'Frontend\CartController@mines')->name('mines_cart');
Route::get('home/danh-muc/cart/checkout', 'Frontend\CartController@index')->name('checkout');