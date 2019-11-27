<?php

namespace Modules\ProductStockNowAfter\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Product\Entities\Product;

class ProductStockNowAfter extends Model
{
	protected $fillable = ['date_delivery_now', 'date_delivery_after'];


	public function product()
	{
		return $this->belongsTo(Product::class);
	}

	public function getTakenNowAttribute()
	{
		return $this->available_now-$this->left_now;
	}

	public function getTakenAfterAttribute()
	{
		return $this->available_after-$this->left_after;
	}


}
