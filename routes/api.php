<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

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


Route::group(['prefix' => '/v1', 'as' => 'api.*', 'namespace' => 'Api\v1'], function () {


    // получить token клиента
    Route::get('/getClientToken', [
        'as' => 'getClientToken',
        'uses' => 'TokenController@getToken',
    ]);

    // получить список сертификатов
    Route::get('/certificate','CertificateController@index');
    // получить список всех сертификатов
    Route::get('/certificateAll','CertificateController@indexAll');

    // получить список сертификатов
    Route::post('/loadImage','ImageController@loadImage');


    Route::get('/clearCash',function (){
        Redis::connection()->del('client:token');
    });



});