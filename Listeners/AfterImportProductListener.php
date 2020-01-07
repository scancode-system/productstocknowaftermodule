<?php

namespace Modules\ProductStockNowAfter\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\ProductStockNowAfter\Repositories\ProductStockNowAfterRepository;

class AfterImportProductListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $product_stock_now_after = $event->product()->product_stock_now_after;
        ProductStockNowAfterRepository::update($product_stock_now_after, $event->data());
    }
}
