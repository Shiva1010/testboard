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
Route::post('/register','SuserController@store');
Route::post('/login','SuserController@login');


Route::group(['middleware' => ['auth:suser']], function() {
// 留言版  BoardController
// 寫留言
    Route::post('/board', 'BoardController@store');

// 查看留言
    Route::get('/board/all', 'BoardController@index');

// 按讚跟收回讚
    Route::post('/board/good', 'BoardController@good');

// 讚數
    Route::get('/board/goodcount', 'BoardController@goodcount');


// 查讚者
    Route::post('/board/goodwho', 'BoardController@goodwho');


// 評論留言 MsgController
// 寫評論
    Route::post('/msg/store', 'MsgController@msg/store');


// 回覆評論 ReMsgController
// 寫回覆
    Route::post('/remsg', 'ReMsgController@remsg');
});