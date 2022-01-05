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

Route::get('/', function () {
    return view('main');
});

/** Вывод кодов регионов страны */
Route::get('/regions/{country}', 'Pages@regions');

/** Вывод серий региона страны */
Route::get('/series/{country}/{code}/{series?}', 'Pages@series');

/** Вывод станицы с номером */
Route::get('/n-{number}/{country}', 'Pages@number');
