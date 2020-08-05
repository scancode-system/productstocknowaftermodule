<?php

namespace Modules\ProductStockNowAfter\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\ProductStockNowAfter\Repositories\ProductStockNowAfterRepository;
use \PhpOffice\PhpSpreadsheet\Shared\Date;

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
        $data = $event->data();
        try {
                $data['date_delivery_now'] = Date::excelToDateTimeObject($data['date_delivery_now']);
                $data['date_delivery_after'] = Date::excelToDateTimeObject($data['date_delivery_after']);
        } catch (Exception $e) {
                // Do Nothing
        }
        $product_stock_now_after = $event->product()->product_stock_now_after;
        ProductStockNowAfterRepository::update($product_stock_now_after, $data);
    }
}
