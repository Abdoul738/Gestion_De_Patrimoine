<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\testController;
use App\Http\Controllers\LoginRegistController;
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

Route::view('register','register')->name("register");
Route::view('login','login')->name("login");
Route::post('loginUser','App\Http\Controllers\LoginRegistController@login');
Route::post('/registerUser','App\Http\Controllers\LoginRegistController@registerUser');
Route::view('list-P','listP')->name("listP");
Route::view('login','login')->name("login");
Route::view('add-patrimoine','add-patrimoine')->name("add-patrimoine");
Route::post('saveP','App\Http\Controllers\ControllerPatrimoine@save');

// Route::group(['middleware'=>'customAuth'],function(){
//     Route::get('/list','App\Http\Controllers\LoginRegistController@list');
//     Route::view('/add','add');
//     Route::post('addResto','App\Http\Controllers\LoginRegistController@addResto');
//     Route::view('register','register');
//     Route::view('logins','logins');
//     Route::get('logout','App\Http\Controllers\LoginRegistController@logout');
// });
