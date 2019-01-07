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

use Illuminate\Support\Facades\Route;


// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

// Registration Routes...
//Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//Route::post('register', 'Auth\RegisterController@register');


//alle routen in dieser gruppe sind durch auth geschützt
Route::group(['middleware' => 'auth'], function () {

    //Dashboard
    Route::get('/', 'DashboardController@index')->name("main")->middleware("auth");

    //Klienten
    Route::get('/klienten', 'KlientenController@index')->name("klienten");
    Route::get('/klient/create', 'KlientenController@create')->name("klientenCreate");
    Route::post('/klient/create', 'KlientenController@doCreate')->name("klientenDoCreate");
    Route::get('/klient/show/{id}', 'KlientenController@show')->name("klientenShow");
    Route::any('/klient/edit/{id}', 'KlientenController@edit')->name("klientenEdit");
    Route::post('/klient/edit', 'KlientenController@doEdit')->name("klientenDoEdit");


    //Dokumentation
    Route::any('/doku', 'DokuController@index')->name("doku");
    Route::post('/doku/neuerEintrag', 'DokuController@neuerEintrag');
    Route::any('/doku/alle', 'DokuController@alle')->name("dokuAlle");
    Route::any('/doku/todo', 'DokuController@toDo')->name("dokuToDo");
    Route::any('/doku/suche', 'DokuController@suche')->name("dokuSuche");
    Route::any('/doku/{klienten_id}', 'DokuController@klient')->name("dokuKlient");
    Route::any('/doku/erledigt/{doku_id}', 'DokuController@erledigt')->name("dokuErledigt");

    //Überweisungen
    Route::get('/ueberweisung', 'KlientenController@ueberweisungScreen');
    Route::post('/doUeberweisung', 'KlientenController@doUeberweisung');


});
