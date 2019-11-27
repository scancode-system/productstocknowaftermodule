<?php

Route::prefix('productstocknowafter')->middleware('auth')->group(function() {
	Route::put('{product_stock_now_after}', 'ProductStockNowAfterController@update')->name('productstocknowafter.update');
});

