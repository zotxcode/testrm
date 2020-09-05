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


Route::post('register', 'UserController@register');
Route::post('login', 'UserController@login');
Route::get('findRoomNearMe', 'RoomController@findRoomNearMe');

Route::group(['middleware' => ['auth:api','role:finance']], function () {
    Route::get('finance', 'FinanceController@welcome');
});

Route::group(['middleware' => ['auth:api','role:article']], function () {
    Route::get('article', 'ArticleController@welcome');
});

Route::group(['middleware' => ['auth:api','role:building']], function () {
    Route::get('building', 'BuildingController@welcome');
});

Route::group(['middleware' => ['auth:api']], function () {
    Route::put('user', 'UserController@update');
    Route::delete('user', 'UserController@delete');
    Route::post('user/change_role', 'UserController@changeRole');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
