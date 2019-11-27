<?php

namespace Modules\ProductStockNowAfter\Http\ViewComposers\Loader\Order;


use Modules\Dashboard\Services\ViewComposer\ServiceComposer;
use Modules\ProductStockNowAfter\Repositories\ProductStockNowAfterRepository;


class ViewProductStockNowAfterComposer extends ServiceComposer {

    private $product_stock_now_after;

    public function assign($view){
        $this->productStockNowAfter();
    }


    private function productStockNowAfter(){
        $this->product_stock_now_after = ProductStockNowAfterRepository::loadByProduct(request()->route('product'));
    }

    public function view($view){
        $view->with('product_stock_now_after', $this->product_stock_now_after);
    }

}