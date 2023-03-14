<?php
Route::group(['prefix' => '/v1/group', 'as' => 'api.*', 'namespace' => 'Api\v1'], function () {
    // Саписать заявку
    Route::post('/addRequest/{type}/{level}','GroupController@addRequest');
    // перейти к другому заданию
    Route::get('/loadRequest/{type}','GroupController@getRequest');

    Route::match(['get', 'post'],'/getList/{type}/{level?}','GroupController@getRequestList');
    // Обновить данные заявки
    Route::post('/update','GroupController@update');
    // создать группу заявок
    Route::post('/createRequestGroup/{type}/{level}','GroupController@createRequestGroup');
    // обновить группу заявок
    Route::post('/updateRequestGroup','GroupController@updateRequestGroup');
    // вывести список групп для заявок
    Route::get('/getGroupList/{type}/{level?}','GroupController@getGroupList');

    // вывести заявоки детских садов
    Route::get('/getAllGroupList','GroupController@getAllGroupList');
    // вывести заявки по всем направлениям
    Route::get('/getKindergartenRequest','GroupController@getKindergartenRequest');
    // загрузить заявки в группе
    Route::get('/loadRequestGroup/{groupId}','GroupController@loadRequestGroup');
    // открыть доступ к прохождению теста
    Route::post('/openTestingForUser','GroupController@openTestingForUser');
    // записать мнение эксперта
    Route::post('/setExpertOpinion/{requestId}','GroupController@setExpertOpinion');
    // удалить выбранную группу заявок
    Route::delete('/groupRequest/{id}','GroupController@delete');
});