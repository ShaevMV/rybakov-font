<?php
Route::group(['prefix' => '/v1/widget', 'as' => 'api.*', 'namespace' => 'Api\v1'], function () {
    // список виджетов
    Route::get('/', 'WidgetController@index');
    Route::get('/editList', 'WidgetController@getListForAdmin');
    // загрузить картинку
    Route::post('/loadImage', 'WidgetController@loadImage');
    // вывести данные для добавления нового элемента
    Route::get('/getNewParams/{template}', 'WidgetController@getNewParams');
    // обновить данные для виджета
    Route::post('/update/{template}', 'WidgetController@updateWidget');
    // загрузить дополнительные данные для витжета
    Route::post('/getJoinData', 'WidgetController@getJoinData');
});