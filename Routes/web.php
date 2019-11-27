<?php

Route::prefix('productstocknowafter')->middleware('auth')->group(function() {
	//get
	Route::get('{product}/view_product_stock_now_after/ajax', 'ProductStockNowAfterController@loadViewProductStockNowAfterAjax')->name('productstocknowafter.view_product_stock_now_after.ajax');	
	// put
	Route::put('{product_stock_now_after}', 'ProductStockNowAfterController@update')->name('productstocknowafter.update');
});

