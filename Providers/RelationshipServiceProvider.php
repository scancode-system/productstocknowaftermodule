<?php

namespace Modules\ProductStockNowAfter\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

use Modules\Product\Entities\Product;
use Modules\ProductStockNowAfter\Entities\ProductStockNowAfter;
use Modules\Order\Entities\Item;
use Modules\ProductStockNowAfter\Entities\ItemProductStockNowAfter;

use Modules\Order\Entities\Order;


class RelationshipServiceProvider extends ServiceProvider
{


    public function boot()
    {
        Product::addDynamicRelation('product_stock_now_after', function (Product $product) {
            return $product->hasOne(ProductStockNowAfter::class);
        });

        Item::addDynamicRelation('item_product_stock_now_after', function (Item $item) {
            return $item->hasOne(ItemProductStockNowAfter::class);
        });
    }



    public function register()
    {

    }

}
