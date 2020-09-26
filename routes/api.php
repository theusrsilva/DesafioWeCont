<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::get('/','Api\AuthController@index')->name('index');
Route::post('/login', 'Api\AuthController@login')->name('login');
Route::post('/cadastro', 'Api\AuthController@store')->name('cadastro');

Route::middleware(['api.auth'])->group(function (){

    Route::post('/senha', 'Api\AuthController@changePassword')->name('senha');
    Route::apiResource('/fatura','Api\InvoiceController');
    Route::post('/info','Api\AuthController@info')->name('info');
    Route::post('/logout','Api\AuthController@logout')->name('logout');

});







