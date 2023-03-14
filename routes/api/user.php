<?php
Route::group(['prefix' => '/v1/user', 'as' => 'api.*', 'namespace' => 'Api\v1'], function () {
    // регистрация
    Route::post('/registration', 'UserController@store');
    // получить данные пользователя
    Route::get('/getUserData', 'UserController@index')
        ->middleware('auth:api');

    // Обновление данных пользователя
    Route::post('/updateUser', 'UserController@update')
        ->middleware('auth:api');

    // вывести список пользователей
    Route::get('/getUserList', 'UserController@getList');

    // проверка что пользователь активен
    Route::get('/activation/{userId}/{token}', 'UserController@userActivation');

    // вывести список уведомлений пользователя
    Route::get('/getNotification', 'NotificationsController@getList');

    // вывести кол-во всех не прочитаных уведомлений
    Route::get('/getCountNotification', 'NotificationsController@getCount');

    // восстановить пароль
    Route::post('/restorePassword', 'UserController@restorePassword');
    // заменить пароль
    Route::post('/changePassword', 'UserController@changePassword');

    // удалить пользователя
    Route::delete('/{id}', 'UserController@destroy');

    // авторизация пользователя
    Route::post('/oauth/token', [
        'uses' => '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken',
    ])->middleware('CheckMail');

});