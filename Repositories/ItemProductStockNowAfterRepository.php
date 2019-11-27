<?php

namespace Modules\ProductStockNowAfter\Repositories;

use Modules\ProductStockNowAfter\Entities\ItemProductStockNowAfter;
use Modules\Order\Entities\Item;
use \Exception;
use \stdClass;

class ItemProductStockNowAfterRepository
{

	// LOADS
	public static function loadByItem(Item $item){
		return ItemProductStockNowAfter::where('item_id', $item->id)->first();
	}

	// CREATES	
	public static function new($item_id, $qty_now, $date_delivery_now, $qty_after, $date_delivery_after){
		$item_product_stock_now_after = new ItemProductStockNowAfter();
		$item_product_stock_now_after->item_id = $item_id;
		$item_product_stock_now_after->qty_now = $qty_now;
		$item_product_stock_now_after->date_delivery_now = $date_delivery_now;
		$item_product_stock_now_after->qty_after = $qty_after;
		$item_product_stock_now_after->date_delivery_after = $date_delivery_after;
		$item_product_stock_now_after->save();
	}

	// UPDATES
	public static function takeAll(ItemProductStockNowAfter $item_product_stock_now_after){
		$taken_off = new stdCLass();
		$taken_off->qty_now = $item_product_stock_now_after->qty_now;
		$taken_off->qty_after = $item_product_stock_now_after->qty_after;

		$item_product_stock_now_after->qty_now = 0;
		$item_product_stock_now_after->qty_after = 0;
		$item_product_stock_now_after->save();

		return $taken_off;
	}

	public static function takeAfter(ItemProductStockNowAfter $item_product_stock_now_after, $qty){
		$item_product_stock_now_after->taken_off = new stdCLass();

		$left = $item_product_stock_now_after->qty_after-$qty; 
		if($left < 0){
			$item_product_stock_now_after = self::takeNow($item_product_stock_now_after, abs($left));
			$item_product_stock_now_after->taken_off->qty_after = $item_product_stock_now_after->qty_after;
			$item_product_stock_now_after->qty_after = 0;
		} else {
			$item_product_stock_now_after->taken_off->qty_after = $qty;
			$item_product_stock_now_after->taken_off->qty_now = 0;
			$item_product_stock_now_after->qty_after = $left;
		}

		$taken_off = $item_product_stock_now_after->taken_off;
		unset($item_product_stock_now_after->taken_off);
		$item_product_stock_now_after->save();
		return $taken_off;
	}


	public static function takeNow(ItemProductStockNowAfter $item_product_stock_now_after, $qty){
		$left = $item_product_stock_now_after->qty_now-$qty; 
		if($left < 0){
				throw new Exception("Máximo de unidades que pode ser retirado deste item  são ".($item_product_stock->qty_now+$item_product_stock->qty_after)." unidades.");
		}
		$item_product_stock_now_after->taken_off->qty_now = $qty;
		$item_product_stock_now_after->qty_now = $left;
		return $item_product_stock_now_after;
	}	

	public static function put(ItemProductStockNowAfter $item_product_stock_now_after, $qty_now, $qty_after){
		$item_product_stock_now_after->qty_now+= $qty_now;
		$item_product_stock_now_after->qty_after+= $qty_after;
		return $item_product_stock_now_after->save();
	}

}
