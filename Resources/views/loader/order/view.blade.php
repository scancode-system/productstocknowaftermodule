<div class="row justify-content-center mb-1 mt-1">
	<div class="col"><strong>Estoque Atual: </strong></div>
	<div class="col">{{ $item->item_product_stock_now_after->qty_now }}</div>
</div>
<div class="row justify-content-center mb-1">
	<div class="col"><strong>Estoque Futuro: </strong></div>
	<div class="col">{{ $item->item_product_stock_now_after->qty_after }}</div>
</div>


