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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/register_user','Api\AuthController@register_user');
Route::post('/login_api','Api\AuthController@auth_login');
Route::get('/consignment_records','Api\ConsignmentsController@index')->middleware('auth:sanctum');
Route::post('/consignment_store','Api\ConsignmentsController@consignment_store')->middleware('auth:sanctum');