<?php

namespace Modules\ProductStockNowAfter\Observers;

use Modules\Order\Entities\Item;
use Modules\ProductStockNowAfter\Repositories\ProductStockNowAfterRepository;
use Modules\ProductStockNowAfter\Repositories\ItemProductStockNowAfterRepository;
use Modules\Order\Repositories\ItemRepository;
use \Exception;

class ItemObserver
{

	public function created(Item $item)
	{
		try{
			$product_stock_now_after = ProductStockNowAfterRepository::loadByProductId($item->product_id);
			$taken_stock = ProductStockNowAfterRepository::takeNow($product_stock_now_after, $item->qty);
			ItemProductStockNowAfterRepository::new($item->id, $taken_stock->qty_now, $product_stock_now_after->date_delivery_now, $taken_stock->qty_after, $product_stock_now_after->date_delivery_after);
		} catch (Exception $e){
			ItemRepository::destroy($item);
			throw new Exception($e->getMessage()); 
		}
	}	

	public function updating(Item $item)
	{
		$product_stock_now_after = ProductStockNowAfterRepository::loadByProductId($item->product_id);
		$item_product_stock_now_after = ItemProductStockNowAfterRepository::loadByItem($item);

		$qty_take_put = $item->qty-$item->getOriginal('qty');
		if($qty_take_put > 0) {
			$taken_stock = ProductStockNowAfterRepository::takeNow($product_stock_now_after, $qty_take_put);
			ItemProductStockNowAfterRepository::put($item_product_stock_now_after, $taken_stock->qty_now, $taken_stock->qty_after);
		} elseif($qty_take_put < 0) {
			$taken_stock = ItemProductStockNowAfterRepository::takeAfter($item_product_stock_now_after, abs($qty_take_put));
			ProductStockNowAfterRepository::put($product_stock_now_after, $taken_stock->qty_now, $taken_stock->qty_after);
		}
	}

	public function deleting(Item $item)
	{
		$item_product_stock_now_after = ItemProductStockNowAfterRepository::loadByItem($item);

		if($item_product_stock_now_after){
			$product_stock_now_after = ProductStockNowAfterRepository::loadByProductId($item->product_id);
			$item_product_stock_now_after = ItemProductStockNowAfterRepository::loadByItem($item);

			$taken_item_stock = ItemProductStockNowAfterRepository::takeAll($item_product_stock_now_after);
			ProductStockNowAfterRepository::put($product_stock_now_after, $taken_item_stock->qty_now, $taken_item_stock->qty_after);
		}
	}

}
