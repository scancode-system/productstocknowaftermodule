<?php

namespace Modules\ProductStockNowAfter\Observers;

use Modules\Product\Entities\Product;
use Modules\ProductStockNowAfter\Repositories\ProductStockNowAfterRepository;

class ProductObserver
{

	public function created(Product $product) {
		ProductStockNowAfterRepository::new($product->id);
	}	

}
