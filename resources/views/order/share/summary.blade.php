<h3>Pedido {{ $share->id }}</h3>
<table class="table table-striped">
    <tr>
        <th>Articulo</th>
        <th>Cantidad</th>
        <th>Precio</th>
    </tr>
    @foreach($share->items as $item)
        <tr>
            <td class="col-xs-8">
                {{ $item->product->name }}
            </td>
            <td class="col-xs-2">
                {{ $item->amount }}&nbsp;{{ $item->unit }}
            </td>
            <td class="col-xs-2">
                {{ $item->price or '__.__' }} &euro;
            </td>
        </tr>
    @endforeach
    <tr>
        <th>
            Total
        </th>
        <th></th>
        <th>{{ $share->total }} &euro;</th>
    </tr>
</table>
<hr>
<h4>Contacto y comentarios</h4>
<p><strong>Telefono:</strong> {{ $share->phone }}</p>
<p><strong>Email:</strong> {{ $share->email }}</p>
<p><strong>Comentarios:</strong> {{ $share->comments }}</p>
<hr>