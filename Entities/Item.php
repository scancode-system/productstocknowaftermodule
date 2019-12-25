<?php

namespace Modules\ProductStockNowAfter\Entities;

use Modules\Order\Entities\Item as ItemBase;
use Modules\ProductStockNowAfter\Entities\ItemProductStockNowAfter;
use Rocky\Eloquent\HasDynamicRelation;
 
class Item extends ItemBase
{
	use HasDynamicRelation;

	public function item_product_stock_now_after()
	{
		return $this->hasOne(ItemProductStockNowAfter::class);
	}


	// accessors



	public function getTotalNowAttribute($value)
	{
		return $this->price_net*$this->item_product_stock_now_after->qty_now;
	}

	public function getTotalGrossNowAttribute($value)
	{
		return $this->price*$this->item_product_stock_now_after->qty_now;
	}


	public function getTotalDiscountValueNowAttribute($value)
	{
		return $this->discount_value*$this->item_product_stock_now_after->qty_now;
	}


	public function getTotalAdditionValueNowAttribute($value)
	{
		return $this->addition_value*$this->item_product_stock_now_after->qty_now;;
	}





	public function getTotalAfterAttribute($value)
	{
		return $this->price_net*$this->item_product_stock_now_after->qty_after;
	}

	public function getTotalGrossAfterAttribute($value)
	{
		return $this->price*$this->item_product_stock_now_after->qty_after;
	}

	public function getTotalDiscountValueAfterAttribute($value)
	{
		return $this->discount_value*$this->item_product_stock_now_after->qty_after;
	}

	public function getTotalAdditionValueAfterAttribute($value)
	{
		return $this->addition_value*$this->item_product_stock_now_after->qty_after;
	}

}
