<?php

namespace Modules\ProductStockNowAfter\Repositories;

use Modules\Order\Repositories\ItemRepository as ItemRepositoryBase;
use Modules\ProductStockNowAfter\Entities\Item;
use Modules\Order\Entities\Status;


class ItemRepository extends ItemRepositoryBase
{

	public static function loadItemsClosedOrders(){
		$items = Item::
		whereHas('order', function ($query) {
			$query->where('status_id', Status::COMPLETED);
		})->
		orderBy('order_id')->
		get();

		return $items;
	}

}
