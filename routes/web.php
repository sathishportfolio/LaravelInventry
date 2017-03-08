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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'customer'], function () {

	Route::get('/create', 'CustomerController@create');
	Route::post('/store', 'CustomerController@store');
	Route::get('/view', 'CustomerController@view');
	Route::get('/index', 'CustomerController@index');
	Route::get('/show/{id}', 'CustomerController@show');
	Route::get('/edit/{id}', 'CustomerController@edit');
	Route::post('/update/{id}', 'CustomerController@update');
	Route::get('/destroy/{id}', 'CustomerController@destroy');

});

Route::group(['prefix' => 'supplier'], function () {

	Route::get('/create', 'SupplierController@create');
	Route::post('/store', 'SupplierController@store');
	Route::get('/view', 'SupplierController@view');
	Route::get('/index', 'SupplierController@index');
	Route::get('/show/{id}', 'SupplierController@show');
	Route::get('/edit/{id}', 'SupplierController@edit');
	Route::post('/update/{id}', 'SupplierController@update');
	Route::get('/destroy/{id}', 'SupplierController@destroy');

});

Route::group(['prefix' => 'category'], function () {

	Route::get('/create', 'CategoryController@create');
	Route::post('/store', 'CategoryController@store');
	Route::get('/view', 'CategoryController@view');
	Route::get('/index', 'CategoryController@index');
	Route::get('/show/{id}', 'CategoryController@show');
	Route::get('/edit/{id}', 'CategoryController@edit');
	Route::post('/update/{id}', 'CategoryController@update');
	Route::get('/destroy/{id}', 'CategoryController@destroy');

});

Route::group(['prefix' => 'stock'], function () {

	Route::get('/create', 'StockController@create');
	Route::post('/store', 'StockController@store');
	Route::get('/view', 'StockController@view');
	Route::get('/index', 'StockController@index');
	Route::get('/show/{id}', 'StockController@show');
	Route::get('/edit/{id}', 'StockController@edit');
	Route::post('/update/{id}', 'StockController@update');
	Route::get('/destroy/{id}', 'StockController@destroy');
	Route::get('/view/availability', 'StockController@view_availability');
	Route::get('/get/availability', 'StockController@get_availability');
	Route::get('/get_stock_count', 'StockController@get_stock_count');

});

Route::group(['prefix' => 'purchase'], function () {

	Route::get('/create', 'PurchaseController@create');
	Route::post('/store', 'PurchaseController@store');
	Route::get('/view', 'PurchaseController@view');
	Route::get('/index', 'PurchaseController@index');
	Route::get('/show/{id}', 'PurchaseController@show');
	Route::get('/edit/{id}', 'PurchaseController@edit');
	Route::post('/update/{id}', 'PurchaseController@update');
	Route::get('/destroy/{id}', 'PurchaseController@destroy');

});

Route::group(['prefix' => 'sales'], function () {

	Route::get('/create', 'SalesController@create');
	Route::post('/store', 'SalesController@store');
	Route::get('/view', 'SalesController@view');
	Route::get('/index', 'SalesController@index');
	Route::get('/show/{id}', 'SalesController@show');
	Route::get('/edit/{id}', 'SalesController@edit');
	Route::post('/update/{id}', 'SalesController@update');
	Route::get('/destroy/{id}', 'SalesController@destroy');

});

Route::group(['prefix' => 'transaction'], function () {

	Route::get('/payments', 'TransactionController@payments');
	Route::get('/get_payments', 'TransactionController@get_payments');
	Route::get('/outstandings', 'TransactionController@outstandings');
	Route::get('/get_outstandings', 'TransactionController@get_outstandings');

});

Route::group(['prefix' => 'search'], function () {

	Route::any('/supplier_name', 'SearchController@supplier_name');

	Route::any('/stock_name', 'SearchController@stock_name');

	Route::any('/customer_name', 'SearchController@customer_name');

	Route::any('/category_name', 'SearchController@category_name');

	Route::any('/purchase_category_name', 'SearchController@purchase_category_name');

});


Route::group(['prefix' => 'report'], function () {

	Route::get('/generate', 'ReportController@generate');

	Route::any('/view_report', 'ReportController@view_report');

	Route::any('/pdf_report', 'ReportController@pdf_report');

});