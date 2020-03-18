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


Auth::routes(['register' => true]);

Route::middleware('auth')->group(function() {
  Route::get('/', 'DashboardController@index')->name('dashboard');
  Route::get('/dashboard', 'DashboardController@index');
  Route::resource('users', 'UserController');

  Route::prefix('users')->group(function () {
    Route::get('/profile', 'UserController@profile')->name('user-profile');
    Route::post('/profile', 'UserController@updateProfile')->name('update-profile');
    Route::get('/delete/{id}', 'UserController@destroy')->name('delete-user');
  });

  Route::prefix('project')->group(function () {
    Route::get('/', 'ProjectController@index')->name('project-index');
    Route::get('/create', 'ProjectController@create')->name('project-create');
    Route::post('/store', 'ProjectController@store')->name('store-project');
    Route::post('/store/emails', 'ProjectController@importEmails')->name('store-project-emails');
    Route::post('/store/address', 'ProjectController@importAddress')->name('store-project-address');
    Route::post('/store/final/edit', 'ProjectController@importFinalEdit')->name('store-project-final-edit');
    Route::get('/delete/{id}', 'ProjectController@delete')->name('delete-project');
    Route::post('/name', 'ProjectController@storeName')->name('create-project-name');
    Route::get('/setup/{id}', 'ProjectController@show')->name('project-setup');
    Route::get('/create/{id}', 'ProjectController@ceateSetup')->name('project-setup-create');
    Route::get('/edit/{id}', 'ProjectController@editSetup')->name('project-setup-edit');
    Route::get('/final/{id}', 'ProjectController@finalEditSetup')->name('project-setup-final-edit');
    Route::get('/pay/{id}', 'ProjectController@paySetup')->name('project-setup-pay');
    Route::get('/update', 'ProjectController@updateProjectDetail')->name('update-project-detail');
    Route::get('/final/export/{id}', 'ProjectController@exportFinal')->name('project-final-export');
    Route::get('/edit/export/{id}', 'ProjectController@exportEdit')->name('project-edit-export');
    Route::post('/assign/email', 'ProjectController@assignEmails')->name('project-assign-email');
    Route::prefix('download')->group(function () {
      Route::get('/email', 'ProjectController@downloadEmailSample')->name('project-download-email');
      Route::get('/address', 'ProjectController@downloadAddressSample')->name('project-download-address');
      Route::get('/final', 'ProjectController@downloadfinalSample')->name('project-download-final');
    });
  });


  Route::resource('bussiness', 'BussinessController');
  Route::get('/bussiness/delete/{id}', 'BussinessController@delete')->name('delete-bussiness-type');

  Route::resource('category', 'CategoryController');
  Route::get('/category/delete/{id}', 'CategoryController@delete')->name('delete-category');

  Route::resource('formulas', 'FormulaController');
  Route::get('formulas/delete/{id}', 'FormulaController@destroy')->name('formulas.delete');

  Route::resource('client', 'ClientController');
  Route::get('client/delete/{id}', 'ClientController@destroy')->name('client.delete');

  Route::resource('todo', 'TodoController');
  Route::get('todo/delete/{id}', 'TodoController@destroy')->name('todo.delete');
  Route::post('todo/file/{id}', 'TodoController@fileupload')->name('todo.fileupload');
  Route::post('todo/timespend/{id}', 'TodoController@timespend')->name('todo.timespend');
  Route::get('todo/{id}/show', 'TodoController@show')->name('todo.showtodo');
  Route::post('todo/{id}/comment', 'TodoController@comment')->name('todo.comment');


  //route to track the time spend on the particular project
  Route::post('todo/toDoTrackerStartProject', 'TodoController@toDoTrackerStartProject')->name('todo.toDoTrackerStartProject');

  Route::post('todo/toDoTrackerEndProject', 'TodoController@toDoTrackerEndProject')->name('todo.toDoTrackerEndProject');
});
