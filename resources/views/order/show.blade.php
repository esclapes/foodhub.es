@extends('layouts.app');

@section('content')
    @each('order.share.summary', $order->shares, 'share')
@stop