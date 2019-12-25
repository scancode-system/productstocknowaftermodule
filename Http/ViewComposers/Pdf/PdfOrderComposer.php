<?php

namespace Modules\ProductStockNowAfter\Http\ViewComposers\Pdf;

use Modules\Dashboard\Services\ViewComposer\ServiceComposer;
use Modules\ProductStockNowAfter\Entities\Order;

class PdfOrderComposer extends ServiceComposer {

    private $order;
    private $count_hidden_columns;

    public function assign($view){
        $this->order($view->order);
        $this->fewerColumns($view->setting_pdf);
    }


    private function order($order){
        $this->order = Order::with(['order_client', 'order_client.order_client_address', 'order_saller', 'order_payment', 'items', 'items.item_product'])->find($order->id);
        //dd($this->order);
    }

    private function fewerColumns($setting_pdf)
    {
        $this->count_hidden_columns = $setting_pdf->count_hidden_columns;
    }


    public function view($view){
        $view->with('order', $this->order);
        $view->with('count_hidden_columns', $this->count_hidden_columns);
    }

}