<?php
Route::group(['prefix' => '/v1/kindergarten', 'as' => 'api.*', 'namespace' => 'Api\v1'], function () {
    // получить список детских садов
    Route::get('/getList','KindergartenController@getList');
    // сохранить координаты для детского сада
    Route::post('/saveCoordinates/{id}','KindergartenController@saveCoordinates');
});