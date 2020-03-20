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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', function () {
    return view('index');
});


Route::post('/board', function () {
    return view('/board');
});

Route::get('/board', function () {
    return view('/board');
});

Route::post('/whogood', function () {
    return view('whogood');
});

//Route::get('/board',function (){
//    return view('/board');
//});

Route::post('/user', function () {
    return view('user');
});


Route::post('/testqq', function () {
    return view('testqq');
});



Route::post('/storeboard', 'BoardController@store');

Route::get('/board', 'BoardController@allboard')->name('allboard');
//Route::get('/board', 'BoardController@allgood');

Route::post('/register','SuserController@store');
Route::get('/yes','SuserController@store');

Route::post('/login','SuserController@login');

Route::post('/msg', 'BoardController@msg');
Route::post('/remsg', 'BoardController@remsg');
Route::post('/good','BoardController@good');
//Route::post('/good','BoardController@good');

//Route::post('/allmsg', 'BoardController@allmsg');
//Route::get('/msg/store', 'MsgController@msg/store');

Route::get('/test', 'SuserController@test');