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

Route::get('/ticketView/{ticket}', 'viewTicketController@index')->name('/ticketView');
Route::post('/ticketView/{ticket}/post', 'viewTicketController@store');
Route::post('/ticketView/{ticket}/close', 'viewTicketController@close');

Route::get('/ticketSent', 'viewTicketSentController@index')->name('/viewTicketSent');
Route::get('/ticketSent/sent', ['as'=>'get.data','uses'=>'viewTicketSentController@getTickets']);

Route::get('/ticketGet', 'viewTicketGetController@index')->name('/viewTicketGet');
Route::get('/ticketGet/get', ['as'=>'datas.get','uses'=>'viewTicketGetController@getTickets']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*Route::get('/register', ['middleware' => 'isAdmin:1', function () {
    return "eres mayor de edad y puedes ver este contenido";
}]);*/


Route::get('auth/register', function () {
    return view('/register');
})->middleware('auth', 'isAdmin:1');