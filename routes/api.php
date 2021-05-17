<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserinfoController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\BuyController;



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

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'authenticate']);
Route::post('updateUserInfo', [UserinfoController::class, 'updateUserInfo']);
Route::post('getUserInfo', [UserinfoController::class, 'getUserInfo']);
Route::post('getSellData', [SellController::class, 'getSellData']);
Route::post('saveSell', [SellController::class, 'saveSell']);
Route::get('getPriceChaos', [BuyController::class, 'getPriceChaos']);
Route::post('getBuyData', [BuyController::class, 'getBuyData']);




Route::get('open', 'DataController@open');

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('user', 'UserController@getAuthenticatedUser');
    Route::get('closed', 'DataController@closed');
});