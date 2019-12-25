<?php

namespace Modules\ProductStockNowAfter\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Order\Entities\Order as OrderBase;
use Modules\ProductStockNowAfter\Entities\Item;
use Rocky\Eloquent\HasDynamicRelation;

 

class Order extends OrderBase
{
	use HasDynamicRelation;


	public function items_stock_now()
	{
		return $this->hasMany(Item::class)->whereHas('item_product_stock_now_after', function($query){
			$query->where('qty_now', '>', 0);
		});
	}

		public function items_stock_after()
	{
		return $this->hasMany(Item::class)->whereHas('item_product_stock_now_after', function($query){
			$query->where('qty_after', '>', 0);
		});
	}

	// accesscor
	public function getTotalItemsNowAttribute($value)
	{
		return $this->items_stock_now->count();
	}

	public function getTotalUnitsNowAttribute($value)
	{
		$sum = 0;
		foreach ($this->items_stock_now as $item) {
			$sum+= $item->item_product_stock_now_after->qty_now;
		}
		return $sum;
	}

	public function getTotalNowAttribute($value)
	{
		$sum = 0;
		foreach ($this->items_stock_now as $item) {
			$sum+= $item->total_now;
		}
		return $sum;
	}


	public function getTotalGrossNowAttribute($value)
	{
		$sum = 0;
		foreach ($this->items_stock_now as $item) {
			$sum+= $item->total_gross_now;
		}
		return $sum;
	}


	public function getDiscountValueNowAttribute($value)
	{
		$sum = 0;
		foreach ($this->items_stock_now as $item) {
			$sum+= $item->total_discount_value_now;
		}
		return $sum;
	}

	public function getAdditionValueNowAttribute($value)
	{
		$sum = 0;
		foreach ($this->items_stock_now as $item) {
			$sum+= $item->total_addition_value_now;
		}
		return $sum;
	}



	public function getTotalItemsAfterAttribute($value)
	{
		return $this->items_stock_after->count();
	}

		public function getTotalUnitsAfterAttribute($value)
	{
		$sum = 0;
		foreach ($this->items_stock_after as $item) {
			$sum+= $item->item_product_stock_now_after->qty_after;
		}
		return $sum;
	}

	public function getTotalAfterAttribute($value)
	{
		$sum = 0;
		foreach ($this->items_stock_after as $item) {
			$sum+= $item->total_after;
		}
		return $sum;
	}


	public function getTotalGrossAfterAttribute($value)
	{
		$sum = 0;
		foreach ($this->items_stock_after as $item) {
			$sum+= $item->total_gross_after;
		}
		return $sum;
	}


	public function getDiscountValueAfterAttribute($value)
	{
		$sum = 0;
		foreach ($this->items_stock_after as $item) {
			$sum+= $item->total_discount_value_after;
		}
		return $sum;
	}

	public function getAdditionValueAfterAttribute($value)
	{
		$sum = 0;
		foreach ($this->items_stock_after as $item) {
			$sum+= $item->total_addition_value_after;
		}
		return $sum;
	}


}
