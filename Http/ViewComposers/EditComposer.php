<?php

namespace Modules\ProductStockNowAfter\Http\ViewComposers;


use Modules\Dashboard\Services\ViewComposer\ServiceComposer;
use Modules\ProductStockNowAfter\Repositories\ProductStockNowAfterRepository;


class EditComposer extends ServiceComposer {

    private $product_stock_now_after;

    public function assign($view){
        $this->productStockNowAfter($view->product);
    }


    private function productStockNowAfter($product){
        $this->product_stock_now_after = ProductStockNowAfterRepository::loadByProduct($product);
    }

    public function view($view){
        $view->with('product_stock_now_after', $this->product_stock_now_after);
    }

}