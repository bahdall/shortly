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

Route::post('/', 'LinkController@create')->middleware(\App\Http\Middleware\CheckToken::class);
Route::get('/{hash}', 'LinkController@redirect')->name('link.redirect')->middleware(\App\Http\Middleware\LimitRequestCount::class);

