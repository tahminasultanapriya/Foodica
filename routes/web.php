<?php

use GuzzleHttp\Psr7\Request;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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




Route::get('store_image', 'StoreImageController@index');
Route::post('store_image/insert_image', 'StoreImageController@insert_image');
Route::get('store_image/fetch_image/{id}', 'StoreImageController@fetch_image');
Route::view('/welcome', 'welcome');


Route::name('blogs_path')->get('/blog','BlogsController@index');
Route::name('create_blog_path')->get('/blog/create','BlogsController@create');
Route::name('store_blog_path')->post('/blog','BlogsController@store');
Route::name('blog_path')->get('/blog/{id}','BlogsController@show');
Route::name('edit_blog_path')->get('/blog/{id}/edit','BlogsController@edit');
Route::name('update_blog_path')->put('/blog/{id}','BlogsController@update');
Route::name('delete_blog_path')->delete('/blog/{id}','BlogsController@destroy');


//Foodica

Route::name('first_page_path')->get('/foodica','FoodicaController@index');

Auth::routes();

Route::get('/', function() {
    return view('auth.login');

});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home_page', 'PostsController@addPost1')->name('home_page');
Route::get('/home_view/{id}', 'PostsController@home_view')->name('home_view_post');
Route::get('/post', 'PostsController@show')->name('post')->middleware('auth');
Route::get('/profile', 'ProfileController@profile')->name('profile')->middleware('auth');
Route::get('/category', 'CategoriesController@category')->name('category')->middleware('auth');
Route::post('/addCategory', 'CategoriesController@addCategory')->name('add_category')->middleware('auth');
Route::post('/addProfile', 'ProfileController@addProfile')->name('add_profile')->middleware('auth');
Route::post('/addPost', 'PostsController@addPost')->name('add_post')->middleware('auth');
Route::get('/view/{id}', 'PostsController@view')->name('view_post')->middleware('auth');
Route::get('/edit/{id}', 'PostsController@edit')->name('update_post')->middleware('auth');
Route::post('/editPost/{id}', 'PostsController@editPost')->name('edit_post')->middleware('auth');
Route::get('/delete/{id}', 'PostsController@deletePost')->name('delete_post')->middleware('auth');
Route::get('/category/{id}', 'PostsController@category')->name('category_post')->middleware('auth');
Route::get('/like/{id}', 'PostsController@like')->name('like')->middleware('auth');
Route::get('/dislike/{id}', 'PostsController@dislike')->name('dislike')->middleware('auth');
Route::post('/comment/{id}', 'PostsController@comment')->name('comment')->middleware('auth');
Route::post('/search', 'PostsController@search')->name('search')->middleware('auth');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout')->middleware('auth');


