<?php

namespace Modules\ProductStockNowAfter\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Modules\ProductStockNowAfter\Http\ViewComposers\Pdf\PdfOrderComposer;
use Modules\ProductStockNowAfter\Http\ViewComposers\Loader\Pdf\Data\OrderComposer;

class ViewComposerServiceProvider extends ServiceProvider {

	public function boot() {
		// pdf
		View::composer(['productstocknowafter::pdf.order', 'productstocknowafter::pdf.data.order'], PdfOrderComposer::class);
		View::composer('productstocknowafter::pdf.data.order', OrderComposer::class);
	}

	public function register() {
        //
	}

}
