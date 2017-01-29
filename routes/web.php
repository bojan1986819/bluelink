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
    if(Auth::check()){return Redirect::to('home');}
    return view('welcome');
});

Auth::routes();

Route::get('/home', [ 
    'uses' => 'HomeController@index',
    'as' => 'home',
    'middleware' => 'auth'
]);

Route::get('/users', [
    'uses' => 'UsersController@getUserList',
    'as' => 'users',
    'middleware' => 'admin'
]);

Route::get('/deleteuser/{user_id}', [
    'uses' => 'UsersController@getDeleteUser',
    'as' => 'deleteuser',
    'middleware' => 'admin'
]);

Route::get('/userteam/{user_id}', [
    'uses' => 'UserTeamController@getTeamList',
    'as' => 'userteam',
    'middleware' => 'admin'
]);

Route::post('/addteam', [
    'uses' => 'UserTeamController@postAddTeam',
    'as' => 'addteam'
]);

Route::get('/deleteteam/{team_id}', [
    'uses' => 'UserTeamController@getDeleteTeam',
    'as' => 'deleteteam',
    'middleware' => 'admin'
]);

Route::get('/userpayroll/{payroll_id}', [
    'uses' => 'UserPayrollController@getPayrollList',
    'as' => 'userpayroll',
    'middleware' => 'admin'
]);

Route::post('/addpayroll', [
    'uses' => 'UserPayrollController@postAddPayroll',
    'as' => 'addpayroll'
]);

Route::get('/deletepayroll/{payroll_id}', [
    'uses' => 'UserPayrollController@getDeletePayroll',
    'as' => 'deletepayroll',
    'middleware' => 'admin'
]);