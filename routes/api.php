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
Route::post('login', 'PassportController@login');

Route::middleware('auth:api')->group(function () {

    Route::get('user', 'PassportController@details');

    Route::delete('logout', 'PassportController@revokeCurrentToken');

    Route::post('preference/store', 'PreferenceController@store');

    //Route::get('user/requests', 'RequestController@GetRequests');

	//Route::post('mercadopago', 'MercadoPagoController@MercadoPagoRequest');

	//Route::get('mercadopago/news', 'NewsController@getPendingNews');

	//Route::get('mercadopago/news/all', 'NewsController@getAllNews');

	//Route::post('mercadopago/news/check', 'NewsController@setDownloadAt');

	//Route::get('mercadopago/news/single/{id}', 'NewsController@getNew');
});
