<?php

namespace App;


use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductPrice extends Pivot
{

    protected $table = 'product_prices';

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function getPriceValueAttribute() {
        return isset($this->attributes['price_value']) ?: $this->product->price_value;
    }

    public function getPriceAmountAttribute() {
        return isset($this->attributes['price_amount']) ?: $this->product->price_amount;
    }

    public function getPriceUnitAttribute() {
        return isset($this->attributes['price_unit']) ?: $this->product->price_unit;
    }

    public function getStepAmountAttribute() {
        return isset($this->attributes['step_amount']) ?: $this->price_amount;
    }

    public function getStepUnitAttribute() {
        return isset($this->attributes['step_unit']) ?: $this->price_unit;
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
