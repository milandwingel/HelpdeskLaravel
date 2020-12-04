<?php

use App\Http\Controllers\TicketController;
use App\Http\Controllers\CommentController;
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
    return view('welcome');
});

Route::get('/dit/is/een/test', 'TestController@simpeleTest');

Route::get('/toon/database', function () {
    return view('test2')->with('default', config('database.default'));
});

Route::get('/param/{id}', 'TestController@testParam')->where('id', '[1-9][0-9]*');

Route::get('/show/database', function() {
    return view('toonDatabase');
});
Route::get('/show/database', function () {

    $items = DB::table('roles')->get();

    return view('toonDatabase', ['items' => $items]);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/ticket/create', 'TicketController@create')->name('ticket_create');

Route::post('/ticket/save', 'TicketController@save')->name('ticket_save');;

Route::get('/ticket/index', 'TicketController@index')->name('ticket_index_customer');

Route::get('/ticket/{id}/show', 'TicketController@show')->name('ticket_show');

Route::put('/ticket/{id}/update', 'TicketController@update')->name('ticket_update');

Route::post('/ticket/{id}/comment/save', 'CommentController@save')->name('comment_save');

Route::get('/ticket/index_helpdesk', 'TicketController@index_helpdesk')->name('ticket_index_helpdesk');

Route::put('ticket/{id}/close', 'TicketController@close')->name('ticket_close');



