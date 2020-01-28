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
    Route::get('/create', 'ProjectController@create')->name('project-create');
    Route::post('/store', 'ProjectController@store')->name('store-project');
    Route::post('/name', 'ProjectController@storeName')->name('create-project-name');
    Route::get('/setup/{id}', 'ProjectController@show')->name('project-setup');
    Route::get('/create/{id}', 'ProjectController@ceateSetup')->name('project-setup-create');
    Route::get('/edit/{id}', 'ProjectController@editSetup')->name('project-setup-edit');
    Route::get('/update', 'ProjectController@updateProjectDetail')->name('update-project-detail');
    Route::post('/assign/email', 'ProjectController@assignEmails')->name('project-assign-email');
    Route::prefix('download')->group(function () {
      Route::get('/email', 'ProjectController@downloadEmailSample')->name('project-download-email');
      Route::get('/address', 'ProjectController@downloadAddressSample')->name('project-download-address');
    });
  });
  Route::prefix('bussiness')->group(function () {
    Route::get('/create', 'ProjectController@createBussiness')->name('create-bussiness');
    Route::post('/create', 'ProjectController@storeBussiness')->name('store-bussiness');
  });
  Route::prefix('category')->group(function () {
    Route::get('/create', 'ProjectController@createCategory')->name('create-category');
    Route::post('/create', 'ProjectController@storeCategory')->name('store-category');
  });
});
