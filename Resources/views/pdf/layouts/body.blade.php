@if($order->items_stock_now->count() > 0)
<table class="w-100 mb-3">
	<thead>
		<tr>
			<th  colspan="{{ 6+$count_show_columns }}" class="border-bottom border-top border-dark border-left border-right p-2">Items do Estoque Atual</th>
		</tr>
	</thead>
	<thead>
		<tr>
			@if($setting_pdf_image->show)
			<th class="border-bottom border-top border-dark border-left p-2">Img</th>
			@endif
			<th class="border-bottom border-top border-dark {{ (!$setting_pdf_image->show)?'border-left':'' }} p-2">Ref</th>
			<th class="border-bottom border-top border-dark p-2">Descrição</th>
			@loader(['loader_path' => 'pdf.items.thead'])
			<th class="border-bottom border-top border-dark p-2 text-center">Preço</th>
			@if($setting_pdf_discount->show)
			<th class="border-bottom border-top border-dark p-2 text-center">Desc</th>
			@endif
			@if($setting_pdf_addition->show)
			<th class="border-bottom border-top border-dark p-2 text-center">Acres</th>
			@endif
			@if($setting_pdf_taxes->show)
			<th class="border-bottom border-top border-dark p-2 text-center">Impostos</th>
			@endif
			<th class="border-bottom border-top border-dark p-2 text-center">Quant</th>
			<th class="border-bottom border-top border-dark p-2 text-center">Total</th>
			<th class="border-bottom border-top border-dark border-right p-2 text-center">Entrega</th>
		</tr>
	</thead>  
	<tbody>
		@foreach($order->items_stock_now as $item)
		<tr>
			@if($setting_pdf_image->show)
			<td class="border-bottom border-left border-dark p-2">
				<img src="{{ url($item->item_product->image) }}" class="width-75">
			</td>
			@endif
			<td class="border-bottom border-dark {{ (!$setting_pdf_image->show)?'border-left':'' }} p-2">{{ $item->item_product->sku }}</td>
			<td class="border-bottom border-dark p-2">{{ $item->item_product->description }}</td>
			@loader(['loader_path' => 'pdf.items.tr'])
			<td class="border-bottom border-dark text-center p-2">@currency($item->price)</td>
			@if($setting_pdf_discount->show)
			<td class="border-bottom border-dark text-center p-2">@currency($item->discount_value)</td>
			@endif
			@if($setting_pdf_addition->show)
			<td class="border-bottom border-dark text-center p-2">@currency($item->addition_value)</td>
			@endif
			@if($setting_pdf_taxes->show)
			<td class="border-bottom border-dark text-center p-2">@currency($item->tax_value)<br><small>(ipi)</small></td>
			@endif
			<td class="border-bottom border-dark text-center p-2">{{ $item->item_product_stock_now_after->qty_now }}</td>
			<td class="border-bottom border-dark text-center p-2">@currency($item->total_now)</td>
			<td class="border-bottom border-right border-dark text-center p-2">{{ $item->item_product_stock_now_after->date_delivery_now?$item->item_product_stock_now_after->date_delivery_now->format('d/m/Y'):'N/A' }}</td>
		</tr> 
		@endforeach
	</tbody>
	<tfoot>
		<tr>
			<th class="border-bottom border-dark border-left p-2" colspan="{{ 3+$count_show_columns }}">Totais</th>
			<th class="border-bottom border-dark p-2 text-center">{{ $order->total_units_now }}</th>
			<th class="border-bottom border-dark  p-2 text-center">@currency($order->total_now)</th>
			<th class="border-bottom border-dark border-right p-2 text-center"></th>
		</tr>
	</tfoot>
</table>
@endif

@if($order->items_stock_after->count() > 0)
<table class="w-100 mb-3">
	<thead>
		<tr>
			<th  colspan="{{ 6+$count_show_columns }}" class="border-bottom border-top border-dark border-left border-right p-2">Items do Estoque Futuro</th>
		</tr>
	</thead>
	<thead>
		<tr>
			@if($setting_pdf_image->show)
			<th class="border-bottom border-top border-dark border-left p-2">Img</th>
			@endif
			<th class="border-bottom border-top border-dark {{ (!$setting_pdf_image->show)?'border-left':'' }} p-2">Ref</th>
			<th class="border-bottom border-top border-dark p-2">Descrição</th>
			<th class="border-bottom border-top border-dark p-2 text-center">Preço</th>
			@if($setting_pdf_discount->show)
			<th class="border-bottom border-top border-dark p-2 text-center">Desc</th>
			@endif
			@if($setting_pdf_addition->show)
			<th class="border-bottom border-top border-dark p-2 text-center">Acres</th>
			@endif
			@if($setting_pdf_taxes->show)
			<th class="border-bottom border-top border-dark p-2 text-center">Impostos</th>
			@endif
			<th class="border-bottom border-top border-dark p-2 text-center">Quant</th>
			<th class="border-bottom border-top border-dark p-2 text-center">Total</th>
			<th class="border-bottom border-top border-dark border-right p-2 text-center">Entrega</th>
		</tr>
	</thead> 
	<tbody>
		@foreach($order->items_stock_after as $item)
		<tr>
			@if($setting_pdf_image->show)
			<td class="border-bottom border-left border-dark p-2">
				<img src="{{ url($item->item_product->image) }}" class="width-75">
			</td>
			@endif
			<td class="border-bottom border-dark {{ (!$setting_pdf_image->show)?'border-left':'' }} p-2">{{ $item->item_product->sku }}</td>
			<td class="border-bottom border-dark p-2">{{ $item->item_product->description }}</td>
			<td class="border-bottom border-dark text-center p-2">@currency($item->price)</td>
			@if($setting_pdf_discount->show)
			<td class="border-bottom border-dark text-center p-2">@currency($item->discount_value)</td>
			@endif
			@if($setting_pdf_addition->show)
			<td class="border-bottom border-dark text-center p-2">@currency($item->addition_value)</td>
			@endif
			@if($setting_pdf_taxes->show)
			<td class="border-bottom border-dark text-center p-2">@currency($item->tax_value)<br><small>(ipi)</small></td>
			@endif
			<td class="border-bottom border-dark text-center p-2">{{ $item->item_product_stock_now_after->qty_after }}</td>
			<td class="border-bottom border-dark text-center p-2">@currency($item->total_after)</td>
			<td class="border-bottom border-right border-dark text-center p-2">{{ $item->item_product_stock_now_after->date_delivery_now?$item->item_product_stock_now_after->date_delivery_now->format('d/m/Y'):'N/A' }}</td>
		</tr> 
		@endforeach
	</tbody>
	<tfoot>
		<tr>
			<th class="border-bottom border-dark border-left p-2" colspan="{{ 3+$count_show_columns }}">Totais</th>
			<th class="border-bottom border-dark p-2 text-center">{{ $order->total_units_after }}</th>
			<th class="border-bottom border-dark  p-2 text-center">@currency($order->total_after)</th>
			<th class="border-bottom border-dark border-right p-2 text-center"></th>
		</tr>
	</tfoot>
</table>
@endif
