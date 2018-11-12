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

Route::get('/welcome', function () {
    return view('welcome');
});


Route::get('/', function () {
    return view('index');
});


Route::get('/newTicket', 'newTicketController@index')->name('/newTicket');
Route::post('/newTicket', 'newTicketController@store');

Route::get('/viewTicket', 'viewTicketController@index')->name('/viewTicket');