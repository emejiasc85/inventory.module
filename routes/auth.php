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

	Route::name('index')->get('/home', 'HomeController@index');
	Route::name('index')->get('/', 'HomeController@index');

	//commerces
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

	//makes

	Route::get('agregar-marcas', [
		'uses'	=> 'CreateMakeController@create',
		'as'	=> 'makes.create'
	]);
	Route::post('agregar-marcas', [
		'uses'	=> 'CreateMakeController@store',
		'as'	=> 'makes.store'
	]);

	Route::get('editar-marcas/{make}/{slug}', [
		'uses'	=> 'EditMakeController@edit',
		'as'	=> 'makes.edit'
	]);
	Route::put('editar-marcas/{make}', [
		'uses'	=> 'EditMakeController@update',
		'as'	=> 'makes.update'
	]);

	Route::get('marcas', [
		'uses'	=> 'MakesController@index',
		'as'	=> 'makes.index'
	]);
	Route::get('marcas/{make}/logo', [
		'uses' 	=> 'MakesController@logo',
		'as'	=> 'makes.logo'
	]);

	//product_groups
	Route::get('agregar-grupo-de-productos', [
		'uses'	=> 'CreateProductGroupController@create',
		'as'	=> 'product.groups.create'
	]);
	Route::post('agregar-grupo-de-productos', [
		'uses'	=> 'CreateProductGroupController@store',
		'as'	=> 'product.groups.store'
	]);
	Route::get('editar-grupo-de-productos/{group}/{slug}', [
		'uses'	=> 'EditProductGroupController@edit',
		'as'	=> 'product.groups.edit'
	]);
	Route::put('editar-grupo-de-productos/{group}', [
		'uses'	=> 'EditProductGroupController@update',
		'as'	=> 'product.groups.update'
	]);

	Route::get('grupos-de-productos', [
		'uses'	=> 'ProductGroupsController@index',
		'as'	=> 'product.groups.index'
	]);

	//products presentations
	Route::get('agregar-presentacion-de-productos', [
		'uses'	=> 'CreateProductPresentationsController@create',
		'as'	=> 'product.presentations.create'
	]);
	Route::post('agregar-presentacion-de-productos', [
		'uses'	=> 'CreateProductPresentationsController@store',
		'as'	=> 'product.presentations.store'
	]);
	Route::get('editar-presentaciones-de-productos/{presentation}/{slug}', [
		'uses'	=> 'EditProductPresentationsController@edit',
		'as'	=> 'product.presentations.edit'
	]);
	Route::put('editar-presentaciones-de-productos/{presentation}', [
		'uses'	=> 'EditProductPresentationsController@update',
		'as'	=> 'product.presentations.update'
	]);
	Route::get('presentaciones-de-productos', [
		'uses'	=> 'ProductPresentationsController@index',
		'as'	=> 'product.presentations.index'
	]);

	//unit measures
	Route::get('agregar-unidades-de-medidas', [
		'uses'	=> 'CreateUnitMeasuresController@create',
		'as'	=> 'unit.measures.create'
	]);
	Route::post('agregar-unidades-de-medidas', [
		'uses'	=> 'CreateUnitMeasuresController@store',
		'as'	=> 'unit.measures.store'
	]);
	Route::get('editar-unidad-de-medidad/{unit}/{slug}', [
		'uses'	=> 'EditUnitMeasuresController@edit',
		'as'	=> 'unit.measures.edit'
	]);
	Route::put('editar-unidad-de-medidad/{unit}', [
		'uses'	=> 'EditUnitMeasuresController@update',
		'as'	=> 'unit.measures.update'
	]);

	Route::get('unidades-de-medidas', [
		'uses' 	=> 'UnitMeasuresController@index',
		'as'	=> 'unit.measures.index'
	]);

	//products

	Route::get('producto/{product}-{slug}', [
		'uses' 	=> 'ProductController@show',
		'as'	=> 'products.show'
	]);
	Route::get('agregar-productos', [
		'uses'	=> 'CreateProductsController@create',
		'as'	=> 'products.create'
	]);
	Route::post('agregar-productos', [
		'uses'	=> 'CreateProductsController@store',
		'as'	=> 'products.store'
	]);
	Route::get('editar-producto/{product}/{slug}', [
		'uses'	=> 'EditProductsController@edit',
		'as'	=> 'products.edit'
	]);
	Route::put('editar-producto/{product}', [
		'uses'	=> 'EditProductsController@update',
		'as'	=> 'products.update'
	]);

	Route::get('productos', [
		'uses'	=> 'ProductController@index',
		'as'	=> 'products.index'
	]);

	//product -images
	Route::get('producto/{product}-{slug}/agregar-imagen', [
		'uses' 	=> 'ProductImagesController@create',
		'as'	=> 'product.images.create'
	]);
	Route::post('producto/{product}/agregar-imagen', [
		'uses' 	=> 'ProductImagesController@store',
		'as'	=> 'product.images.store'
	]);
	Route::get('image/{image}', [
		'uses' 	=> 'ProductImagesController@img',
		'as'	=> 'product.images.img'
	]);
	Route::delete('image/delete', [
		'uses' 	=> 'ProductImagesController@delete',
		'as'	=> 'product.images.delete'
	]);

	//warehouses
	Route::get('agregar-bodega', [
		'uses' 	=> 'CreateWarehouseController@create',
		'as'	=> 'warehouses.create'
	]);
	Route::post('agregar-bodega', [
		'uses' 	=> 'CreateWarehouseController@store',
		'as'	=> 'warehouses.store'
	]);
	Route::get('editar-bodega/{warehouse}/{slug}', [
		'uses'	=> 'EditWarehouseController@edit',
		'as'	=> 'warehouses.edit'
	]);
	Route::put('editar-bodega/{warehouse}', [
		'uses'	=> 'EditWarehouseController@update',
		'as'	=> 'warehouses.update'
	]);

	Route::name('warehouses.index')->get('bodegas', 'WarehousesController@index');
	//order types
	Route::name('orders.type.index')->get('tipos-de-orden', 'OrderTypeController@index');
	Route::name('orders.type.create')->get('agregar-tipo-de-orden', 'CreateOrderTypeController@create');
	Route::name('orders.type.store')->post('agregar-tipo-de-orden', 'CreateOrderTypeController@store');
	Route::name('orders.type.edit')->get('editar-tipo-de-orden-{type}', 'EditOrderTypeController@edit');
	Route::name('orders.type.update')->put('editar-tipo-de-orden-{type}', 'EditOrderTypeController@update');
	//orders
	Route::name('orders.index')->get('pedidos', 'OrderController@index');
	Route::name('orders.show')->get('ordenes/detalle/orden-{order}', 'OrderController@show');
	Route::name('orders.create')->get('agregar-orden', 'CreateOrderController@create');
	Route::name('orders.store')->post('agregar-orden', 'CreateOrderController@store');
	Route::name('orders.edit')->get('editar-orden/{order}', 'EditOrderController@edit');
	Route::name('orders.update')->put('editar-orden/{order}', 'EditOrderController@update');
	Route::name('orders.updateStatus')->put('editar-status-orden/{order}', 'EditOrderController@updateStatus');
	//order details
	Route::name('orders.details.create')->get('orden/{order}/agregar-detalle', 'CreateOrderDetailsController@create');
	Route::name('orders.details.store')->post('orden/{order}/agregar-detalle', 'CreateOrderDetailsController@store');
	Route::name('orders.details.update')->put('{detail}/editar-detalle', 'EditOrderDetailsController@update');

	Route::name('orders.details.destroy')->delete('orden/{order}/eliminar-detalle', 'DeleteOrderDetailsController@destroy');

















