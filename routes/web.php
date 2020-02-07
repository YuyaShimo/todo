<?php

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/folders/create', 'FolderController@showCreateForm')->name('folders.create');
    Route::post('/folders/create', 'FolderController@create');

    Route::group(['middleware' => 'can:view,folder'], function() {
        Route::get('/folders/{folder}/tasks', 'TaskController@index')->name('tasks.index');

        Route::get('/folders/{folder}/tasks/create', 'TaskController@showCreateForm')->name('tasks.create');
        Route::post('/folders/{folder}/tasks/create', 'TaskController@create');

        Route::get('/folders/{folder}/tasks/{task}/edit', 'TaskController@showEditForm')->name('tasks.edit');
        Route::post('/folders/{folder}/tasks/{task}/edit', 'TaskController@edit');

    });
    //ユーザーページへのルーティング
    Route::get('/users', 'UsersController@showUsers')->name('users.showUsers');
    //ユーザー名変更ページへのルーティング
    Route::get('/users/edit', 'UsersController@editUsers')->name('users.editUsers');
    //ユーザー名変更のルーティング
    Route::post('/users/edit','UsersController@updateUsers')->name('users.updateUsers');
});

Auth::routes();