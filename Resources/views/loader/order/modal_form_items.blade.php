<div id="{{ $modal_id }}_container_view_product_stock">

</div>

@push('scripts')
<script>
	$(document).ready(function(){
		@if(!isset($item))
		$('#select_products').change(function(){
			$("#{{ $modal_id }}_container_view_product_stock").load("{{ url('/') }}/productstocknowafter/"+this.value+"/view_product_stock_now_after/ajax");
		});
		@else
			$("#{{ $modal_id }}_container_view_product_stock").load("{{ url('/') }}/productstocknowafter/{{ $item->product_id }}/view_product_stock_now_after/ajax");
		@endif
	});
</script>
@endpush