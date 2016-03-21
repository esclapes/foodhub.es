@extends('layouts.app')

@section('content')
    <div class="row row--spaced">
        <div class="col-xs-12">
            <h2>Pedido confirmado</h2>
            <p>Aquí tienes un resument de tu pedido</p>
        </div>
    </div>
    <hr>
    @include('order.share.summary')


@stop