<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// обработка запросов с vue-router
Route::get('/{vue_capture?}', function () {
    return view('index');
})->where('vue_capture', '^(?!(?:api|docs|storage|Certificates|admin))[\/\w\.-]*');

Route::get('/admin/{any?}', function () {
    return view('admin');
})->where('any', '.*');