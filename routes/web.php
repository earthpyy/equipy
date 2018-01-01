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

Route::get('/lent/uncompleted', 'LentController@showUncompleted')->name('lent.uncompleted');
Route::get('/lent/history', 'LentController@showHistory')->name('lent.history');
Route::get('/lent/borrow', 'LentController@borrow')->name('lent.borrow');
Route::get('/lent/borrower/{id}', 'LentController@borrower');

Route::post('/thing/detail', 'ThingController@detail');

Route::post('/borrower/get', 'BorrowerController@get');

Route::resources([
    'type' => 'TypeController', 
    'thing' => 'ThingController',
    'lent' => 'LentController',
    'borrower' => 'BorrowerController'
]);