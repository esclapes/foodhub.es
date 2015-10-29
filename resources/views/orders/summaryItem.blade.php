<a class="no-underline" href="{{ action('OrdersController@show', ['id' => $order->id]) }}">
    <div class="panel panel-default">
        <div class="panel-heading"><h4>#{{ $order->id }} - {{ $order->name }}</h4></div>
        <div class="panel-body">{{ count($order->products) }} productos</div>
    </div>
</a>
