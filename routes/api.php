<?php

use Illuminate\Http\Request;

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
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/calculo',function()
{
    return 'hola mundo';
});
Route::get('/calculo/{id}','CalculoController@index');
Route::post('/capacitacion/v1/ecuaciones','CalculoController@calcular');

