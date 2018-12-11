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

Route::get('/sector', 'sectorController@index');
Route::post('/sector', 'sectorController@store');

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*Route::get('/register', ['middleware' => 'isAdmin:1', function () {
    return "eres mayor de edad y puedes ver este contenido";
}]);*/


/*Route::get('auth/register', function () {
    dd(Auth::user());
})->middleware('admin');
*/
