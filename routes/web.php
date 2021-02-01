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


Route::get('/', 'BlogController@getBlogs');
Route::get('add_blog', function(){
	return view('add_blog');
});


Route::group(['middleware' => ['auth']], function(){	
	Route::post('store_blog', 'BlogController@storeBlog');
	Route::get('edit_blog/{id}', 'BlogController@editBlog')->name('edit_blog');
	Route::post('update_blog', 'BlogController@updateBlog')->name('update_blog');
	Route::get('delete_blog/{id}', 'BlogController@deleteBlog')->name('delete_blog');
});


Route::get('/register', 'Auth\AuthController@register')->name('register');
Route::post('/register', 'Auth\AuthController@storeUser');

Route::get('/login', 'Auth\AuthController@login')->name('login');
Route::post('/login', 'Auth\AuthController@authenticate');
Route::get('logout', 'Auth\AuthController@logout')->name('logout');

Route::get('/list_blogs', 'BlogController@getBlogs')->name('list_blogs');