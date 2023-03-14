<?php
Route::group(['prefix' => '/v1/platform', 'as' => 'api.*', 'namespace' => 'Api\v1'], function () {
    // платформы
    Route::get('/getList', 'PlatformController@index');
    // удалить платформу
    Route::delete('/{id}', 'PlatformController@destroy');
    // Добавить обновить платформу
    Route::post('/addPlatforms', 'PlatformController@store')
        ->middleware('auth:api');

});