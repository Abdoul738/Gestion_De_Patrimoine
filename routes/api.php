<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginRegistController;
use App\Http\Controllers\testController;
use App\Http\Controllers\ControllerPatrimoine;
//use App\Http\Controllers\CommentController;

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
Route::get('/getapatrimoinebyuserid/{id}',[ControllerPatrimoine::class,'getpatrimoinebyuserid']);
Route::get('/getpatrimoinebnumber/{id}',[ControllerPatrimoine::class,'getpatrimoinebnumber']);
Route::get('/validerpatrimoine/{id}',[ControllerPatrimoine::class,'validerpatrimoine']);
Route::get('/retirerpatrimoine/{id}',[ControllerPatrimoine::class,'retirerpatrimoine']);
Route::get('/getapatrimoine/{id}',[ControllerPatrimoine::class,'getOnepatrimoine']);
Route::get('/getcommentsnumber/{id}',[ControllerPatrimoine::class,'getcommentsnumber']);
Route::get('/getPatrimoines',[ControllerPatrimoine::class,'getpatrimoines']);
Route::get('/getpatrimoinesnumber',[ControllerPatrimoine::class,'getpatrimoinesnumber']);
Route::get('/getpatrimoinesvalidated',[ControllerPatrimoine::class,'getpatrimoinesvalidated']);
Route::post('/registerUser',[LoginRegistController::class,'registerUser']);
Route::post('/verifyprofil',[LoginRegistController::class,'login']);
Route::post('/createuser',[testController::class,'create']);
Route::post('/saveP',[ControllerPatrimoine::class,'save']);

Route::post('/comment',[ControllerPatrimoine::class,'comment']);
Route::get('/getprimarycomment/{id}',[ControllerPatrimoine::class,'getprimarycomment']);
Route::get('/getuser/{id}',[ControllerPatrimoine::class,'getuser']);
Route::get('/getlat/{id}',[ControllerPatrimoine::class,'getlat']);
Route::get('/getlong/{id}',[ControllerPatrimoine::class,'getlong']);
Route::get('/getsecondarycomment',[ControllerPatrimoine::class,'getsecondarycomment']);

Route::get('images/{filename}', function ($filename)
{
    $file = \Illuminate\Support\Facades\Storage::get($filename);
    return response($file, 200)->header('Content-Type', 'image/jpeg');
});
