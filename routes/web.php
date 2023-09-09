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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/','Admin\LoginController@index')->name('login');
Route::get('/registration','Admin\LoginController@registration')->name('registration');
Route::post('/post_login','Admin\LoginController@login_post')->name('post_login');
Route::post('/create_user','Admin\LoginController@create_user')->name('create_user');
Route::group(['prefix' => 'admin','namespace' =>'Admin','middleware'=>['checkApiResponse']], function() {
    Route::get('/consignment','DashboardController@index')->name('consignment_view');
    Route::get('/create','DashboardController@create')->name('consignment_create');
    Route::post('/store','DashboardController@store')->name('consignment_store');
    Route::get('/export_pdf','DashboardController@export_pdf')->name('export_pdf');
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
