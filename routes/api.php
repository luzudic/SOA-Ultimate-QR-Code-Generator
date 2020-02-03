<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'Api\AuthController@login');
    Route::post('signup', 'Api\AuthController@signup');
    Route::get('signup/activate/{token}', 'Api\AuthController@signupActivate');

    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('logout', 'Api\AuthController@logout');
        Route::get('user', 'Api\AuthController@user');
        Route::get('myapps', 'Api\AppController@index');
        Route::post('code/create', 'Api\CodeController@store');
        Route::put('code/update', 'Api\CodeController@update');
        Route::get('code/show', 'Api\CodeController@show');
        Route::get('code/list', 'Api\CodeController@index');

    });
});

Route::group([
    'namespace' => 'Auth',
    'middleware' => 'api',
    'prefix' => 'password'
], function () {
    Route::post('create', 'Api\PasswordResetController@create');
    Route::get('find/{token}', 'Api\PasswordResetController@find');
    Route::post('reset', 'Api\PasswordResetController@reset');
});

Route::get('chart/{id}', 'Api\ChartController@show');
