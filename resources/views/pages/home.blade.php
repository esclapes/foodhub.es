@extends('layouts.default')

@section('content')
	@if(Auth::check())
		<h2>Tus pedidos</h2>
		@each('orders.summaryItem', Auth::user()->orders, 'order', 'orders.summaryEmpty')
		{!! dump(Auth::user()->orders)  !!}
	@else
		@include('auth.login')
	@endif

@stop