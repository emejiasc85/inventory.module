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


Route::get('/home', 'HomeController@index');


Route::get('agregar-comercio', [
	'uses'	=> 'CreateCommerceController@create',
	'as'	=> 'commerces.create'
]);
Route::post('agregar-comercio', [
	'uses'	=> 'CreateCommerceController@store',
	'as'	=> 'commerces.store'
]);
Route::get('{commerce}/{slug}/editar', [
	'uses' => 'EditCommerceController@edit',
	'as'	=> 'commerces.edit'
]);

Route::put('{commerce}/editar', [
	'uses' => 'EditCommerceController@update',
	'as'	=> 'commerces.update'
]);

Route::get('{commerce}/logo', [
	'uses' 	=> 'CommerceController@logo',
	'as'	=> 'commerces.logo'
]);

