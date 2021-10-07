<?php

//ルート設定 
Route::group(['middleware' => 'auth'], function() {


	//=========トップページ表示処理==========
	Route::get('/', 'HomeController@index')->name('home');

	//=========フォルダー一覧表示============
	//フォルダーページ表示処理
	Route::get('/folders/{id}/tasks', 'TaskController@index')->name('tasks.index');

	//==========フォルダー作成ページ=========
	//ページ作成表示処理
	Route::get('/folders/create', 'FolderController@showCreateForm')->name('folders.create');
	//フォルダー作成処理
	Route::post('/folders/create', 'FolderController@create');

	//==========タスク作成ページ=============
	//タスク作成表示処理
	Route::get('/folders/{id}/tasks/create', 'TaskController@showCreateForm')->name('tasks.create');
	//タスク作成処理
	Route::post('/folders/{id}/tasks/create', 'TaskController@create');

	//==========タスク編集ページ=============
	//タスク編集ページ処理
	Route::get('/folders/{id}/tasks/{task_id}/edit', 'TaskController@showEditForm')->name('tasks.edit');
	//タスク編集処理
	Route::post('/folders/{id}/tasks/{task_id}/edit', 'TaskController@edit');
	//タスク削除処理
        //Route::post('/folders/{id}/tasks/{task_id}/delete', 'TaskController@del')->name('tasks.delete');
	Route::delete('/folders/{id}/tasks/{task_id}/delete', 'TaskController@del')->name('tasks.delete');
});

Auth::routes();

