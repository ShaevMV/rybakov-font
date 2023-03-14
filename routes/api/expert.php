<?php
Route::group(['prefix' => '/v1/expert',
    'as' => 'api.*',
    'namespace' => 'Api\v1',
    'middleware' => 'auth:api'], function () {
    // вывести список экспертов
    Route::get('/getExpertsList','ExpertController@getExpertsList');

    // вывести список групп заявок
    Route::get('/getGroupList','ExpertController@getGroupList');

    // Добавить эксперта
    Route::post('/add','ExpertController@addExpert');
});