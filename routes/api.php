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

Route::post('get-categories', 'CategoryController@getCategories');
Route::post('add-category','CategoryController@add');
Route::post('edit-category/{id}', 'CategoryController@edit');
Route::delete('delete-category/{id}', 'CategoryController@delete');

Route::get('word-detail/{id}','WordController@show')->name('word.show');
Route::post('get-words', 'WordController@getWords');
Route::post('add-word','WordController@add');
Route::post('edit-word/{id}', 'WordController@edit');
Route::delete('delete-word/{id}', 'WordController@delete');

Route::post('add-user','UserController@store');

Route::get('getAllUsers','UserController@getAllUsers');

Route::post('add-Advertising','AdvertisingController@store');
Route::post('edit-Advertising/{id}','AdvertisingController@edit');
Route::delete('delete-Advertising/{id}','AdvertisingController@delete');
Route::get('getAllAdvertising','AdvertisingController@getAllAdvertising');

Route::post('add-Statistice','StatisticeController@store');
Route::post('edit-Statistice/{id}','StatisticeController@edit');
Route::delete('delete-Statistice/{id}','StatisticeController@destroy');
Route::get('getStatisticeById/{id}','StatisticeController@getStatisticeById');
Route::get('getAllStatistices','StatisticeController@getAllStatistices');
Route::get('getCountInstallApplication','StatisticeController@getCountInstallApplication');
Route::get('getCountOnlineApplication','StatisticeController@getCountOnlineApplication');

Route::post('timeuser', 'TimeUseController@storeTimeUser');
Route::post('gettimeuser', 'TimeUseController@getTimeUser');
Route::post('create', 'TimeUseController@store');
