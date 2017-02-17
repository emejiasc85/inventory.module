<?php

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|
| Here is where you can register auth routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "auth" middleware group. Now create something great!
|
*/

Route::get('{commerce}/{slug}/editar', [
	'uses' => 'EditCommerceController@edit',
	'as'	=> 'commerces.edit'
]);

Route::PUT('{commerce}/editar', [
	'uses' => 'EditCommerceController@update',
	'as'	=> 'commerces.update'
]);


