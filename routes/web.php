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

/* User Routes */
    Route::get('/','UserController@showLogin')->name('user.login.get');

    Route::post('login','UserController@login')->name('user.login.post');

    Route::post('register','UserController@register')->name('user.register.post');

    Route::post('send-reset-password-token','UserController@sendResetPasswordToken')->name('user.forgot.post');

    Route::get('reset/{reset_token}','UserController@showResetPasswordView')->name('user.reset.get');

    Route::post('reset','UserController@resetPassword')->name('user.reset.post');


    Route::group(['middleware'  =>  'auth'],function () {

      /* Student Routes */
      Route::get('student', 'StudentsController@showAll')->name('student.view');

      Route::get('student/{id}/edit', ['uses'=>'StudentsController@showEdit'])->name('student.edit.get');

      Route::put('student/{id}', ['uses'=>'StudentsController@update'])->name('student.edit.put');

      Route::delete('student/{id}', ['uses'=>'StudentsController@delete'])->name('student.delete');

      Route::get('student/create','StudentsController@showCreate')->name('student.create.get');

      Route::post('student/create','StudentsController@create')->name('student.create.post');

      /* User Routes */
      Route::get('logout','UserController@logout')->name('user.logout');

    });
