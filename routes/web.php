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


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('contact', 'ContactController');
Route::get('/all-contact', 'ContactController@allContact')->name('all.contact');

Route::resource('student', 'StudentController');
Route::get('all-student','StudentController@allStudents')->name('all.student');
