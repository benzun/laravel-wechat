<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();
Route::get('/', 'IndexController@index');
Route::group(['middleware' => 'auth'],function (){
    Route::get('/', 'IndexController@index');
    // 微信
    Route::controller('wechat', 'WechatController');
});