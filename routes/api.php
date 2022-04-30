<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginRegistController;
use App\Http\Controllers\testController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//other

Route::get('/getUsers/{email}',[LoginRegistController::class,'getUser']);
Route::post('/registerUser',[LoginRegistController::class,'registerUser']);
Route::post('/verifyprofil',[LoginRegistController::class,'login']);
Route::post('/createuser',[testController::class,'create']);
Route::post('/saveP',[ControllerPatrimoine::class,'save']);
