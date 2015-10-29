<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderShare extends Model
{
    protected $table = 'order_shares';

    protected $fillable = ['order_id', 'user_id'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function shareholder()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderShareItem::class);
    }

    public function availableProducts(){
        return $this->order()->products();
    }
}
