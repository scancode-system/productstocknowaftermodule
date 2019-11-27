<?php

namespace Modules\ProductStockNowAfter\Repositories;

use Modules\ProductStockNowAfter\Entities\ProductStockNowAfter;
use Modules\Product\Entities\Product;
use \Exception;
use \stdClass;

class ProductStockNowAfterRepository
{
	// LOADS
	public static function loadByProductId($product_id){
		return ProductStockNowAfter::where('product_id', $product_id)->first();
	}

	public static function loadByProduct(Product $product){
		return ProductStockNowAfter::where('product_id', $product->id)->first();
	}

	// CREATES
	public static function new($product_id){
		$product_stock_now_after = new ProductStockNowAfter();
		$product_stock_now_after->product_id = $product_id;
		$product_stock_now_after->available_now = 0;
		$product_stock_now_after->left_now = 0;

		$product_stock_now_after->available_after = 0;
		$product_stock_now_after->left_after = 0;
		$product_stock_now_after->save();
	}

	// UPDATES
	public static function update(ProductStockNowAfter $product_stock_now_after, $data){
		$product_stock_now_after->fill($data);
		if(isset($data['available_now'])){
			$product_stock_now_after = self::updateAvailableNow($product_stock_now_after, $data['available_now']);
		}
		if(isset($data['available_after'])){
			$product_stock_now_after = self::updateAvailableAfter($product_stock_now_after, $data['available_after']);
		}
		return $product_stock_now_after->save();
	}

	public static function updateAvailableNow(ProductStockNowAfter $product_stock_now_after, $qty){
		$qty_take_put = $qty-$product_stock_now_after->available_now; 
		
		$taken = $product_stock_now_after->taken_now;
		$product_stock_now_after->available_now = $qty;
		$product_stock_now_after->left_now+= $qty_take_put;
		if($product_stock_now_after->left_now < 0){
			throw new Exception("O Estoque disponibilizado atual não pode diminuir mais que ".$taken.".");
		} 

		return $product_stock_now_after;
	}

	public static function updateAvailableAfter(ProductStockNowAfter $product_stock_now_after, $qty){
		$qty_take_put = $qty-$product_stock_now_after->available_after; 
		
		$taken = $product_stock_now_after->taken_after;
		$product_stock_now_after->available_after = $qty;
		$product_stock_now_after->left_after+= $qty_take_put;

		if($product_stock_now_after->left_after < 0){
			throw new Exception("O Estoque disponibilizado futuro não pode diminuir mais que ".$taken.".");
		} 
		
		return $product_stock_now_after;
	}


	public static function takeNow(ProductStockNowAfter $product_stock_now_after, $qty){
		$product_stock_now_after->taken_off = new stdCLass();

		$left = $product_stock_now_after->left_now-$qty; 
		if($left < 0){
			$product_stock_now_after = self::takeAfter($product_stock_now_after, abs($left));
			$product_stock_now_after->taken_off->qty_now = $product_stock_now_after->left_now;
			$product_stock_now_after->left_now = 0;
		} else {
			$product_stock_now_after->taken_off->qty_now = $qty;
			$product_stock_now_after->taken_off->qty_after = 0;
			$product_stock_now_after->left_now = $left;
		}

		$taken_off = $product_stock_now_after->taken_off;
		unset($product_stock_now_after->taken_off);
		$product_stock_now_after->save();
		return $taken_off;
	}


	public static function takeAfter(ProductStockNowAfter $product_stock_now_after, $qty){
		$left_after = $product_stock_now_after->left_after-$qty; 
		if($left_after < 0){
				throw new Exception("Máximo de unidades que pode ser retirado do(a) ".$product_stock_now_after->product->description." são ".($product_stock_now_after->left_now+$product_stock_now_after->left_after)." unidades.");
		}
		$product_stock_now_after->taken_off->qty_after = $qty;
		$product_stock_now_after->left_after = $left_after;
		return $product_stock_now_after;
	}


	public static function put(ProductStockNowAfter $product_stock_now_after, $qty_now, $qty_after){
		$left_now = $product_stock_now_after->left_now+$qty_now;
		$left_after = $product_stock_now_after->left_after+$qty_after;
		if($left_now > $product_stock_now_after->available_now){
			throw new Exception("Produto esta com estoque mais do que o foi configurado.");
		}
		if($left_after > $product_stock_now_after->available_after){
			throw new Exception("Produto esta com estoque futuro mais do que o foi configurado.");
		}

		$product_stock_now_after->left_now = $left_now;
		$product_stock_now_after->left_after = $left_after;
		return $product_stock_now_after->save();
	}

}
