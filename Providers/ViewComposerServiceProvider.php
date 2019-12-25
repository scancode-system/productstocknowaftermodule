<?php

namespace Modules\ProductStockNowAfter\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Modules\ProductStockNowAfter\Http\ViewComposers\Pdf\PdfOrderComposer;


class ViewComposerServiceProvider extends ServiceProvider {

	public function boot() {
		// pdf
		View::composer('productstocknowafter::pdf.order', PdfOrderComposer::class);
	}

	public function register() {
        //
	}

}
