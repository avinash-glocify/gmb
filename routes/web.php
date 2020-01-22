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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::middleware('auth')->group(function() {
  Route::get('/dashboard', 'DashboardController@index');
  Route::prefix('users')->group(function () {
    Route::get('/', 'UserController@index')->name('users-list');
    Route::get('/create', 'UserController@create')->name('create-user');
    Route::post('/store', 'UserController@store')->name('store-user');
    Route::get('/delete/{id}', 'UserController@destroy')->name('delete-user');
  });
  Route::prefix('project')->group(function () {
    Route::get('/', 'ProjectController@index')->name('project-list');
    Route::get('/import', 'ProjectController@import')->name('import-project');
    Route::post('/store', 'ProjectController@store')->name('store-project');
    Route::get('/detail/{id}', 'ProjectController@show')->name('project-detail');
    Route::get('/update', 'ProjectController@updateProjectDetail')->name('update-project-detail');
  });
});
