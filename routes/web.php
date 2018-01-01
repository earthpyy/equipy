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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::resource('type', 'TypeController');

Route::get('/lent/uncompleted', 'LentController@showUncompleted')->name('lent.uncompleted');
Route::get('/lent/history', 'LentController@showHistory')->name('lent.history');
Route::get('/lent/borrow/{borrower?}', 'LentController@borrow')->name('lent.borrow');
Route::get('/lent/borrower/{borrower}', 'LentController@borrower');
Route::resource('lent', 'LentController', ['except' => ['create']]);

Route::post('/thing/detail', 'ThingController@detail');
Route::resource('thing', 'ThingController');

Route::post('/borrower/get', 'BorrowerController@get');
Route::resource('borrower', 'BorrowerController', ['except' => ['show', 'create']]);