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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', 'AuthController@register');
Route::post('authenticate', 'AuthController@authenticate');
Route::post('invalidate', 'AuthController@invalidate');
Route::post('refresh', 'AuthController@refresh');
Route::post('user', 'AuthController@user');
Route::post('confirm', 'AuthController@confirm');
