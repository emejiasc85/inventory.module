<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->group(function() {
    Route::resource('commerces', 'CommerceController');
    Route::resource('people', 'PeopleController');
    Route::resource('invoice', 'InvoiceController');
    Route::resource('invoice-details', 'InvoiceDetailController');
    Route::post('invoice/{invoice}/gift-cards', 'InvoiceGiftCardController@store');
    Route::delete('invoice/{invoice}/gift-cards', 'InvoiceGiftCardController@destroy');
    Route::resource('cash-register', 'CashRegisterController');
    Route::resource('gift-cards', 'GiftCardController');
    Route::resource('stock', 'StockController');
    Route::put('invoices/{invoice}/payments', 'InvoicePaymentController@update');
    Route::put('invoices/{invoice}/reverts', 'InvoiceRevertController@update');
});

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    //return $request->user();
}); */
