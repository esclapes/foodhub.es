@extends('layouts.app')

@section('content')
    <div class="row row--spaced">
        <div class="col-xs-12">
            <h2>#{{ $order->id }} - {{ $order->title }}</h2>
            <p>{{ $order->description }}</p>
            <p class="label label-success">{{ $order->status }}</p>
            <p class="label label-default">
                <span class="glyphicon glyphicon-time"></span>{{ $order->closing_at }}
            </p>
        </div>
    </div>
    <!--
    <div class="row">
        <div class="col-xs-4">
            <div class="panel panel-primary">
                <div class="panel-heading">Pedidos</div>
                <div class="panel-body">
                    <span class="h3">{!! count($order->shares) !!}</span>
                </div>

            </div>e
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
    -->
    <hr>

    <script>
        var vueData = {
            products: {!! json_encode($order->products)  !!}
        }
    </script>

    <h3 class="basket--heading">Productos disponibles</h3>
    {!! BootForm::open()->action(action('ShareController@store', $order)) !!}

    <basket :products="products"></basket>

    {!! BootForm::close() !!}

@stop