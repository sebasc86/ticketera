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

Route::get('/', 'IndexController@index');

Route::get('/sector', 'sectorController@index');
Route::post('/sector', 'sectorController@store');

Route::get('/password', 'passwordUserController@index')->name('/password');
Route::patch('/password/update', ['as'=>'pass.patch','uses'=>'passwordUserController@update']);

Route::get('/new', 'newTicketController@index')->name('/newTicket');
Route::post('/new', 'newTicketController@store');

Route::get('/view/{ticket}', 'viewTicketController@index')->name('/view');

Route::post('/view/post', 'viewTicketController@store');
Route::post('/view/{ticket}/close', 'viewTicketController@close');
Route::post('/view/{ticket}/mail', 'viewTicketController@sendEmail');
Route::get('/view/{ticket}/download/{filename}', 'viewTicketController@download');



Route::get('/sent', 'sentTicketController@index')->name('/sent');
Route::get('/sent/sent', ['as'=>'sent.data','uses'=>'sentTicketController@getTickets']);

Route::get('/get', 'getTicketController@index')->name('/get');
Route::get('/get/get', ['as'=>'datas.get','uses'=>'getTicketController@getTickets']);

Route::get('/get/{id}', 'ticketAllForSectorsController@index')->name('/get');
Route::get('/get/id/ticket', ['as'=>'dataTickets.get','uses'=>'ticketAllForSectorsController@getTickets']);

Route::get('/ticketsAll', 'ticketsAllController@index')->name('/get');
Route::get('/ticketsAll/tickets', ['as'=>'ticketsAll.get','uses'=>'ticketsAllController@getTickets']);

Route::get('/get/sector/tickets', 'getTicketSectorController@index');
Route::get('/get/sector/ticket', ['as'=>'dataSector.get','uses'=>'getTicketSectorController@getTicketsSector']);

Route::get('/users', 'listUsersController@index')->name('/users');
Route::get('/users/all', ['as'=>'usersAll.get','uses'=>'listUsersController@getUsers']);

Route::get('/users/{id}', 'userModifyController@index')->name('/users');
Route::patch('/users/id/update', 'userModifyController@update')->name('/users');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::delete('/ticket/delete', 'deleteTicketController@index');

Route::delete('/users/delete', 'deleteUsersController@delete');




/*Route::get('/register', ['middleware' => 'isAdmin:1', function () {
    return "eres mayor de edad y puedes ver este contenido";
}]);*/


/*Route::get('auth/register', function () {
    dd(Auth::user());
})->middleware('admin');
*/
