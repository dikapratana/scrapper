<?php

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
Route::get('/', 'DashboardController@index')->name('home.frontend');
Route::post('/crawling-post', 'DashboardController@crawling')->name('home.crawling');
Route::get('/crawling-test', 'DashboardController@test')->name('test.crawling');
// Route::get('/', function () {
//     return view('base_template');
// });
