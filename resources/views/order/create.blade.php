@extends('layouts.default')

@section('content')

	<h1>Crear nueva compra</h1>

	{!! BootForm::open()->action('/orders') !!}

		{!! BootForm::text('Nombre', 'name')->hideLabel()->placeholder('Nombre') !!}
		{!! BootForm::text('Descripción', 'description')->hideLabel()->placeholder('Descripción') !!}
		{!! BootForm::date('Fecha cierre del pedido', 'closing_at')->hideLabel()->placeholder('Fecha cierre pedido') !!}
		{!! BootForm::submit('Crear compra')->class('btn btn-primary') !!}

	{!! BootForm::close() !!}


@stop
