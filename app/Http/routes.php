<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('login');
});

//authentication routes
Route::post('/auth/login', 'Auth\JohnsAuthController@authenticate');

Route::get('/loginFailed', function () {
    return view('loginFailed');
});

//logged in user views
Route::get('/userview', function () {
    return view('userview');
});

Route::get('/domainTable', function () {
    return view('domainTable');
});

Route::post('/generateTable', 'GenerateTable@table');

//logged in admin view
Route::get('/adminview', function () {
    return view('adminview');
});
