<?php
Route::group(['prefix' => '/v1/testing', 'as' => 'api.*', 'namespace' => 'Api\v1'], function () {
    // получить список вопросов на тест
    Route::get('/loadQuestions/{type}/{level}/{page}','TestingController@getListQuestions');
    // получить список вопросов на тест
    Route::get('/loadUserAnswer/{training}','TestingController@loadUserAnswer');
    // записать ответ на вопрос
    Route::post('/setAnswerOptions','TestingController@setAnswerOptions');
    // отправить тест на проверку
    Route::post('/submit','TestingController@submitTesting');
    // Удалить вопрос из теста
    Route::delete('/delete/{id}','TestingController@remove');
    // Обновить данные теста
    Route::post('/update/{id}','TestingController@update');
    // Записать ответ пользователя на вопрос в базу данных
    Route::post('/saveQuestions/{type}/{id}','TestingController@saveQuestions');
    // Отправка на емйал результатов тестирования
    Route::post('/pushInEmail/{type}/{idTesting}','TestingController@pushInEmail');

    // проверить что в тесте отвечены все вопросы
    Route::get('/validUserAnswer/{idTesting}','TestingController@validUserAnswer');
});