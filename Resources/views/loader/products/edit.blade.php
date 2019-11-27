<hr>
<div class="brand-card">
	<div class="brand-card-header bg-info h-auto py-2">
		<h2 class="text-white text-capitalize">Informações de Estoque Atual e Futuro</h2>
	</div>
	<div class="brand-card-body border-bottom">
		<div class="lead">
			Unidades Disponíveis - (Estoque Atual) <br>{{ $product_stock_now_after->left_now }}
		</div>
		<div class="lead">
			Unidades Retiradas - (Estoque Atual) <br>{{ $product_stock_now_after->taken_now }}
		</div>
	</div>
	<div class="brand-card-body">
		<div class="lead">
			Unidades Disponíveis - (Estoque Futuro)  <br>{{ $product_stock_now_after->left_after }}
		</div>
		<div class="lead">
			Unidades Retiradas - (Estoque Futuro) <br>{{ $product_stock_now_after->taken_after }}
		</div>
	</div>
</div>

{{ Form::model($product_stock_now_after, ['route' => ['productstocknowafter.update', $product_stock_now_after], 'method' => 'put']) }}
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			{{ Form::label('available_now', 'Total Disponibilizado') }}
			{{ Form::number('available_now', $product_stock_now_after->available_now, ['class' => 'form-control']) }}
		</div>		
	</div>
	<div class="col-md-6">
		{{ Form::label('date_delivery_now', 'Data de entrega') }}
		{{ Form::date('date_delivery_now', $product_stock_now_after->date_delivery_now, ['class' => 'form-control']) }}
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			{{ Form::label('available_after', 'Total Disponibilizado Futuro') }}
			{{ Form::number('available_after', $product_stock_now_after->available_after, ['class' => 'form-control']) }}
		</div>		
	</div>
	<div class="col-md-6">
		{{ Form::label('date_delivery_after', 'Data de entrega  Futuro') }}
		{{ Form::date('date_delivery_after', $product_stock_now_after->date_delivery_after, ['class' => 'form-control']) }}
	</div>
</div>
{{ Form::button('<i class="fa fa-save"></i><span>Salvar Estoque</span>', ['class' => 'btn btn-brand btn-primary', 'type' => 'submit']) }}
{{ Form::close() }}