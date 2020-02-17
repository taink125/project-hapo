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

Route::prefix('member')->name('member.')->group(function() {
    Route::get('search', 'MemberController@index')->name('search');
});

Route::resource('member', 'MemberController', [
	'only' => ['index', 'create', 'store', 'edit', 'update', 'destroy']
]);
