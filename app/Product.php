<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    
    protected $fillable = ['name', 'origin', 'other'];

    public function owner()
    {
        $this->belongsTo('App\User');
    }

    public function orders()
    {
        $this->belongsToMany('App\Order')->withPivot('price_amount', 'price_unit', 'order_amount', 'order_unit')->withTimestamps();
    }
}
