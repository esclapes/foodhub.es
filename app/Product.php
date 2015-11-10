<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    
    protected $fillable = ['name', 'category', 'origin', 'price_value', 'price_amount', 'price_unit', 'step_amount', 'step_unit'];

    public function owner()
    {
        $this->belongsTo('App\User');
    }

    public function orders()
    {
        $this->belongsToMany('App\Order')->withPivot('price_value', 'price_amount', 'price_unit', 'step_amount', 'step_unit')->withTimestamps();
    }
}
