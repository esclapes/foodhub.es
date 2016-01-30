@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('landing.welcome') }}</div>

                <div class="panel-body">
                    {{ trans('landing.introline') }}

                    @foreach($orders as $order)
                        <h2><a href="{{ action('OrderController@show', [$order]) }}">{{ $order->title }}</a></h2>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
