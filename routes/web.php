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
    return view('layouts.app');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//Route members
Route::prefix('member')->name('member.')->group(function() {
    Route::get('search', 'MemberController@index')->name('search');
});

Route::resource('member', 'MemberController', [
	'only' => ['index', 'create', 'store', 'edit', 'update', 'destroy']
]);

//Route customers
Route::prefix('customer')->name('customer.')->group(function() {
	Route::get('search', 'CustomerController@index')->name('search');
});

Route::resource('customer', 'CustomerController', [
	'only' => ['index', 'create', 'store', 'edit', 'update', 'destroy']
]);

//Route projects
Route::prefix('project')->name('project.')->group(function() {
	Route::get('search', 'ProjectController@index')->name('search');
});

Route::resource('project', 'ProjectController', [
	'only' => ['index', 'create', 'store', 'edit', 'update', 'destroy']
]);

//Route status
Route::prefix('status')->name('status.')->group(function() {
	Route::get('search', 'StatusController@index')->name('search');
});

Route::resource('status', 'StatusController', [
	'only' => ['index', 'create', 'store', 'edit', 'update', 'destroy']
]);

//Route tasks
Route::prefix('tasks')->name('tasks.')->group(function() {
	Route::get('search', 'TaskController@index')->name('search');
});

Route::resource('tasks', 'TaskController', [
	'only' => ['index', 'create', 'store', 'edit', 'update', 'destroy']
]);
