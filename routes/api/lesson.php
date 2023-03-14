<?php
Route::group(['prefix' => '/v1/lesson', 'as' => 'api.*', 'namespace' => 'Api\v1'], function () {
    // получить список всех уроков по определённому направлению
    Route::get('/load/{type}','LessonController@selectTask');
    // перейти к другому заданию
    Route::post('/selectTask/{type}','LessonController@selectTask');
    // завершить обучение в определёном направлении
    Route::post('/end/{type}','LessonController@endLesson');
    // добавить урок
    Route::post('/add','LessonController@store');
    Route::post('/update/{lessonId}','LessonController@update');
    // удалить урок
    Route::delete('/remove/{lessonId}','LessonController@remove');
    // получить определённый урок с задачами
    Route::get('/get/{lessonId}','LessonController@getLesson');
    Route::get('/getTask/{taskId}','LessonController@getTask');
    Route::post('/addTask','LessonController@addTask');
    Route::post('/setAnswer/{questionId}','LessonController@setAnswer');

});