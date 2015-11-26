@extends('layouts.default')

@section('content')
		<h2>Pedido abiertos</h2>
		@each('orders.summaryItem', $orders, 'order', 'orders.summaryEmpty')
@stop