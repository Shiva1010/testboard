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
// 測試用
Route::post('/testqq', function () {
    return view('testqq');
});
Route::post('/good','BoardController@good');



// 首頁
Route::get('/', function () {
    return view('index');
});

//Route::group(['middleware' => ['auth:suser']], function() {
// 留言版
    Route::post('/board', function () {
        return view('/board');
    });

    Route::get('/board', function () {
        return view('/board');
    });


// 查看誰按了讚
    Route::post('/whogood', function () {
        return view('whogood');
    });

//});


// 註冊回傳頁面
Route::get('/user', function () {
    return view('user');
});


// 登出回傳頁面
Route::get('/logout', function () {
    return view('logout');
});



//Route::group(['middleware' => ['auth:suser']], function() {
// 留言
// 存留言
    Route::post('/storeboard', 'BoardController@store');
// 留言讚
    Route::post('/good', 'BoardController@good');

// 評論
// 存評論
    Route::post('/msg', 'BoardController@msg');

// 回覆
// 存回覆
    Route::post('/remsg', 'BoardController@remsg');

//});

// board、msg、remsg 由舊到新排序訊息內容轉變數
Route::get('/totalboard', 'BoardController@allboard')->name('allboard');



// 使用者
// 註冊
Route::post('/register','SuserController@store');
// 登入
Route::post('/login','SuserController@login');
// 登出
Route::post('/suser/logout','SuserController@logout');





