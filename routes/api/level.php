<?php
Route::group(['prefix' => '/v1/level', 'as' => 'api.*', 'namespace' => 'Api\v1'], function () {
    // получить список доступных уровней по всем направления
    Route::get('/getAvailableAll','ProgressController@getAvailableLevelAll');
    Route::get('/getAvailable/{type}','ProgressController@getAvailableLevel');
    Route::get('/getNameDirection/{type}','ProgressController@getNameDirection');
    Route::get('/moreDetailsList/{type}','LevelController@getList');
    Route::post('/updateMoreDetail/{id}','LevelController@updateMoreDetail');
});