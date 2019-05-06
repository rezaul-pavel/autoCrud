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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::group(['middleware' => ['resource.maker','auth.acl']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/admin/user', 'Admin\UserController@index');
    Route::get('/admin/user/edit/{id}', 'Admin\UserController@edit');
    Route::get('/admin/user/activate/{id}/{state}', 'Admin\UserController@activate');
    Route::get('/admin/user/destroy/{id}', 'Admin\UserController@destroy');
    Route::post('/admin/user/{id}', 'Admin\UserController@update');
});

