<?php

namespace Modules\ProductStockNowAfter\Http\ViewComposers\Loader\Order;


use Modules\Dashboard\Services\ViewComposer\ServiceComposer;
use Modules\ProductStockNowAfter\Repositories\ItemProductStockNowAfterRepository;


class ViewComposer extends ServiceComposer {

    private $item_product_stock_now_after;

    public function assign($view){
        $this->itemProductStockNowAfter($view);
    }


    private function itemProductStockNowAfter($view){
        $this->item_product_stock_now_after = ItemProductStockNowAfterRepository::loadByItem($view->item);
    }

    public function view($view){
        $view->with('item_product_stock_now_after', $this->item_product_stock_now_after);
    }

}