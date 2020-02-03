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
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/app/code', 'CodeController@index')->name('app-code');
Route::get('/app/code/show/{id}', 'CodeController@show')->name('app-code-show');

Route::get('/redirect/{id}', 'GuestController@redirect');

Route::get('/feedback', 'FeedbackController@index')->middleware('is_admin');
Route::get('/feedback/give', 'FeedbackController@create')->middleware('is_user');
Route::post('/feedback/store', 'FeedbackController@store')->name('feedback-store')->middleware('is_user');

Route::group(['middleware' => ['is_user_group']], function () {

    Route::get('/app', 'AppController@index')->name('app');
    Route::get('/app/create', 'AppController@create')->name('app-create');
    Route::post('/app/store', 'AppController@store')->name('app-store');
    Route::get('/app/show/{id}', 'AppController@show')->name('app-show');
    Route::get('/app/edit/{id}', 'AppController@edit')->name('app-edit');
    Route::post('/app/update', 'AppController@update')->name('app-update');
    Route::get('/app/delete/{id}', 'AppController@destroy')->name('app-destroy');

    Route::get('/app/code/edit/{id}', 'CodeController@edit')->name('app-code-edit');
    Route::post('/app/code/update', 'CodeController@update')->name('app-code-update');

    Route::get('/app/code/visitor', 'VisitorController@index')->name('app-code-visitor')->middleware('is_user');

    Route::get('/password/change', 'PasswordController@create')->name('password-create');
    Route::post('/password/update', 'PasswordController@update')->name('password-update');

});
