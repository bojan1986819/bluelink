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

Route::get('/adduser',[
    'uses' => 'UsersController@getAddUser',
    'as' => 'adduser',
    'middleware' => 'admin'
]);

Route::post('/addnewuser',[
    'uses' => 'UsersController@postAddUser',
    'as' => 'addnewuser',
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

Route::post('/import', [
    'uses' => 'ImportController@postImportExcel',
    'as' => 'import',
    'middleware' => 'admin'
]);

Route::any('/cutoffs', [
    'uses' => 'CutOffsController@phpgridAllCutoffs',
    'as' => 'cutoffs',
    'middleware' => 'admin'
]);

Route::any('/alltickets', [
    'uses' => 'AllEventsController@phpgridAllTickets',
    'as' => 'alltickets',
    'middleware' => 'admin'
]);

Route::any('/allopentickets', [
    'uses' => 'AllEventsController@phpgridAllOpenTickets',
    'as' => 'allopentickets',
    'middleware' => 'auth'
]);

Route::get('/addtomyqueue/{id}',[
    'uses' => 'AllEventsController@getAddToMyQueue',
    'as' => 'addtomyqueue',
    'middleware' => 'auth'
]);

Route::any('/mytickets', [
    'uses' => 'AllEventsController@phpgridMyTickets',
    'as' => 'mytickets',
    'middleware' => 'auth'
]);

Route::get('/reassign/{id}',[
    'uses' => 'AllEventsController@getReassignTicket',
    'as' => 'reassign',
    'middleware' => 'auth'
]);

Route::post('/postreassign',[
    'uses' => 'AllEventsController@postReassignTicket',
    'as' => 'postreassign',
    'middleware' => 'auth'
]);

Route::any('/teamtickets', [
    'uses' => 'AllEventsController@phpgridTeamTickets',
    'as' => 'teamtickets',
    'middleware' => 'auth'
]);

Route::any('/teamfollowups', [
    'uses' => 'AllEventsController@phpgridTeamFollowUps',
    'as' => 'teamfollowups',
    'middleware' => 'auth'
]);

Route::any('/myfollowups', [
    'uses' => 'AllEventsController@phpgridMyFollowUps',
    'as' => 'myfollowups',
    'middleware' => 'auth'
]);

Route::any('/comptickets', [
    'uses' => 'AllEventsController@phpgridCompletedTickets',
    'as' => 'comptickets',
    'middleware' => 'auth'
]);

Route::any('/inprotickets', [
    'uses' => 'AllEventsController@phpgridInProgressTickets',
    'as' => 'inprotickets',
    'middleware' => 'auth'
]);

Route::get('/reopen/{id}',[
    'uses' => 'AllEventsController@getReopenTicket',
    'as' => 'reopen',
    'middleware' => 'auth'
]);

Route::get('/clear',[
    'uses' => 'AllEventsController@getClearDatabase',
    'as' => 'clear',
    'middleware' => 'admin'
]);