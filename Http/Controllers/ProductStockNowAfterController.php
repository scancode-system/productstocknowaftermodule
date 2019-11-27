<?php

namespace Modules\ProductStockNowAfter\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\ProductStockNowAfter\Entities\ProductStockNowAfter;
use Modules\ProductStockNowAfter\Repositories\ProductStockNowAfterRepository;
use Modules\ProductStockNowAfter\Http\Requests\ProductStockNowAfterRequest;
use Modules\Product\Entities\Product;
use \Exception;

class ProductStockNowAfterController extends Controller
{

    public function update(ProductStockNowAfterRequest $request, ProductStockNowAfter $product_stock_now_after){
        try{
            ProductStockNowAfterRepository::update($product_stock_now_after, $request->all());
            return redirect()->route('products.edit', $product_stock_now_after->product)->with('success', 'Estoque atualizado.');
        } catch (Exception $e){
            return back()->withErrors([$e->getMessage()]);
        }
    }

        public function loadViewProductStockNowAfterAjax(Request $request, Product $product){
    	return view('productstocknowafter::loader.order.view_product_stock_now_after');
    }

}
