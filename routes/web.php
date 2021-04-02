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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home','HomeController@upload');

Route::post('/home','HomeController@addTask')->name('add-task');
Route::patch('/home/edit/{id}','HomeController@editTask')->name('edit-task');
Route::delete('/home/delete/{id}','HomeController@deleteTask')->name('delete-task');
