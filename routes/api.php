<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// 使用者 SuserController
// 註冊
Route::post('/frontstore','SuserController@frontstore');
Route::post('/frontlogin','SuserController@frontlogin');

// 查看留言
Route::get('/frontall', 'BoardController@frontall');


Route::group(['middleware' => ['auth:suser']], function() {
// 留言版  BoardController
// 寫留言
    Route::post('/frontboard', 'BoardController@frontboard');
// 寫評論
    Route::post('/frontmsg', 'BoardController@frontmsg');
// 寫回覆
    Route::post('/frontremsg', 'BoardController@frontremsg');
// 按讚跟收回讚
    Route::post('/frontgood', 'BoardController@frontgood');
// 查看讚者
    Route::post('/frontwhogood', 'BoardController@frontwhogood');
// 登出
    Route::post('/frontlogout', 'SuserController@frontlogout');


});