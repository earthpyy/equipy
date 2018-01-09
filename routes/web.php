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

Route::resource('category', 'CategoryController');

Route::get('/borrowing/uncompleted', 'BorrowingController@showUncompleted')->name('borrowing.uncompleted');
Route::get('/borrowing/history', 'BorrowingController@showHistory')->name('borrowing.history');
Route::get('/borrowing/borrow/{borrower?}', 'BorrowingController@borrow')->name('borrowing.borrow');
Route::get('/borrowing/borrower/{borrower}', 'BorrowingController@borrower')->name('borrowing.borrower');
Route::resource('borrowing', 'BorrowingController', ['except' => ['create']]);

Route::post('/equipment/detail', 'EquipmentController@detail');
Route::get('/equipment/defective', 'EquipmentController@defective')->name('equipment.defective');
Route::resource('equipment', 'EquipmentController');

Route::post('/borrower/get', 'BorrowerController@get');
Route::resource('borrower', 'BorrowerController', ['except' => ['show', 'create']]);