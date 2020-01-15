<?php

namespace Modules\ProductStockNowAfter\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Product\Events\AfterImportEvent;
use Modules\ProductStockNowAfter\Listeners\AfterImportProductListener;
use Modules\Product\Events\ProductLazyEagerLoadingEvent;
use Modules\ProductStockNowAfter\Listeners\ProductLazyEagerLoadingListener;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider 
{

	public function boot() 
	{

	}

	public function register() 
	{
		Event::listen(AfterImportEvent::class, AfterImportProductListener::class);
		Event::listen(ProductLazyEagerLoadingEvent::class, ProductLazyEagerLoadingListener::class);
	}

}