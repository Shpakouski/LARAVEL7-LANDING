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


Route::middleware('web')->group(function () {
    Route::get('/', 'IndexController@index')->name('index');
    Route::resource('pages', 'PageController')->only([
        'show', 'store'
    ]);
});

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::name('admin')->resource('pages', 'Admin\PageController');
});

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::name('admin')->resource('pages', 'Admin\PageController');
    Route::name('portfolios')->resource('portfolios', 'Admin\PortfolioController');
    Route::name('services')->resource('services', 'Admin\ServiceController');
});
