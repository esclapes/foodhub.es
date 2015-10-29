<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderShareItem extends Model
{
    protected $table = 'order_share_items';

    protected $fillable = ['product_id', 'order_id', 'share_amount'];

    public $timestamps = false;

    public function orderShare()
    {
        return $this->belongsTo(OrderShare::class);
    }

    public function order()
    {
        return $this->orderShare()->order();
    }

    public function details()
    {
        $product = $this->order()->products()->findOrFail($this->product_id);

        return $product;
    }
}
