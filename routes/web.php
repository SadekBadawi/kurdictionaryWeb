<?php

use App\Http\Controllers\LanguageController;

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
// Auth::routes();
Auth::routes([
    'register'  =>  false,
]);

Route::group(['middleware' => ['auth'] ], function () {
    
    Route::get('/admin', 'StaterkitController@home')->name('home');
    Route::get('/admin/category', 'CategoryController@index')->name('category');

    Route::get('down', function(){
        \Artisan::call('down');
        return redirect('/');
    });

    Route::get('up', function(){
        \Artisan::call('down');
        return redirect('/');
    });
    
});

Route::get('/', 'UserController@index')->name('user-dashboard');