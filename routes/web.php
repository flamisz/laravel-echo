<?php

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

// \DB::listen(function($query) {
//      var_dump($query->sql);
// });

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/articles', 'ArticleController@index');
Route::get('/articles/{article}', 'ArticleController@show');

Route::post('comments', 'CommentController@store')->middleware('auth');
Route::get('/articles/{article}/comments', 'CommentController@index');
