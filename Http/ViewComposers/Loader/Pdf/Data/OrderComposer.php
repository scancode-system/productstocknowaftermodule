<?php

namespace Modules\ProductStockNowAfter\Http\ViewComposers\Loader\Pdf\Data;

use Modules\Dashboard\Services\ViewComposer\ServiceComposer;
use Modules\ProductStockNowAfter\Entities\Order;


class OrderComposer extends ServiceComposer {

    private $order;
    private $count_hidden_columns;

    public function assign($view){
        $this->order($view->order);
        $this->fewerColumns($view->setting_pdf);
    }


    private function order($order){
        $this->order = Order::with(['order_client', 'order_client.order_client_address', 'order_saller', 'order_payment', 'items', 'items.item_product'])->find($order->id);

        $this->order->date_items = [];
        
        $dates = [];

        //dd($dates);

        foreach ($this->order->items as $item) 
        {
           // dd($item->item_product_stock_now_after)
            if($item->item_product_stock_now_after->qty_after > 0)
            {
                if($item->item_product_stock_now_after->date_delivery_after)
                {
                    $key = $item->item_product_stock_now_after->date_delivery_after->format('Y-m');
                }else 
                {
                    $key = 'N/A';
                }

                if(!isset($dates[$key]))
                {
                    $dates[$key] = [
                        'items' => [],
                        'total' => 0,
                        'units' => 0
                    ]; 
                }
                array_push($dates[$key]['items'], $item);
                $dates[$key]['total']+= $item->total;
                $dates[$key]['units']+= $item->item_product_stock_now_after->qty_after;

            }

                //$dates[]   
        }

        $this->order->dates = $dates;
       // dd($dates);
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