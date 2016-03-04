<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{

    protected $fillable = ['price_value', 'price_amount', 'price_unit', 'step_amount', 'step_value'];

    public function orders() {
        return $this->belongsTo(Order::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }


    public static function pricingDefaults()
    {
        return [
            'price_value' => 1,
            'price_amount' => 1,
            'price_unit' => 'ud.',
            'step_unit' => null,
            'step_amount' => null
        ];
    }

}
