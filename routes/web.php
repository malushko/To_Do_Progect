<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'ToDoController@index');

Route::post('post', ['middleware' => 'current_category', 'uses' => 'ToDoController@storeCategory']);

Route::post('postTask', 'ToDoController@storeTask');

Route::post('update-task', 'ToDoController@updateTask');

Route::post('drop-task', 'ToDoController@dropTask');