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
    Route::get('/', function (){
        if(view()->exists('admin.index')){
            $data =[
                'title' => 'Панель администратора',
            ];
            return view('admin.index',$data);
        }
        abort(404);
    })->name('admin.index');
    Route::name('admin')->resource('pages', 'Admin\PageController');
    Route::name('admin')->resource('portfolios', 'Admin\PortfolioController');
    Route::name('admin')->resource('services', 'Admin\ServiceController');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

