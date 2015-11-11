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
Route::post('/auth/login',     'Auth\JohnsAuthController@authenticate');
Route::post('/auth/logout',    'Auth\JohnsAuthController@logout');

Route::get('/loginFailed', function () {
    return view('loginFailed');
});

//logged in user views
Route::get('/userview', ['middleware' => 'auth', function () {
    return view('userview');
}]);

Route::get('/domainTable', ['middleware' => 'auth', function () {
    return view('domainTable');
}]);

//data resources
Route::get ('/generateTable/getTopTable',   'GenerateTable@getTopTable'  );

Route::post('/generateTable/adminAdd',      'GenerateTable@adminAdd'     );

Route::post('/generateTable/makeUserTable', 'GenerateTable@makeUserTable');
Route::get ('/generateTable/getUserTable',  'GenerateTable@getUserTable' );

//logged in admin view
Route::get('/adminview',  ['middleware' => 'auth', function () {
    return view('adminview');
}]);
Route::post('/addview',    ['middleware' => 'auth', function () {
    return view('addview');
}]);
