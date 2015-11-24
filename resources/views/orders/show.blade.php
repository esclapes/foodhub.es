@extends('layouts.default')

@section('content')
    <div class="row row--spaced">
        <div class="col-xs-12">
            <h2>#{{ $order->id }} - {{ $order->name }}</h2>
            <p class="label label-success">abierta</p>
            <p class="label label-default">
                <span class="glyphicon glyphicon-time"></span>{{ $order->closing_at }}
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4">
            <div class="panel panel-primary">
                <div class="panel-heading">Pedidos</div>
                <div class="panel-body">
                    <span class="h3">{!! count($order->shares) !!}</span>
                </div>

            </div>
        </div>
        <div class="col-xs-4">
            <div class="panel panel-primary">
                <div class="panel-heading">Productos</div>
                <div class="panel-body">
                    <span class="h3">{!! count($order->items) !!}</span>
                </div>

            </div>
        </div>
    </div>
    <hr>

    <script>
        var vueData = {
            products: {!! json_encode($order->products)  !!}
        }
    </script>

    <h3 class="basket--heading">Productos disponibles</h3>
    <div id="basket" class="list-group basket">
        {!! BootForm::open()->action(route('orders.shares.store', $order->id)) !!}
        {!! BootForm::hidden('order_id')->value($order->id) !!}
        <basket></basket>
        {!! BootForm::submit('Hacer pedido') !!}
        {!! BootForm::close() !!}
    </div>
@stop