<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'product_prices')->withPivot('id', 'price_value', 'price_amount', 'price_unit', 'step_amount', 'step_unit')->withTimestamps();
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function lastOrder() {
        return $this->orders()->orderBy('id', 'desc')->first();
    }

    public function lastPricing() {
        return $this->lastOrder() ? $this->lastOrder()->pivot->toArray() : [];
    }

    public function getItemPrice($amount) {
        if ($this->pivot->price_unit != $this->pivot->step_unit) {
            return null;
        }
        return  $amount * $this->pivot->price_value / $this->pivot->price_amount;
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

    public function getPricingAttribute() {
        return $this->lastPricing() + self::pricingDefaults();
    }

    public function newPivot(Model $parent, array $attributes, $table, $exists)
    {
        if ($parent instanceof Order) {
            return new ProductPrice($parent, $attributes, $table, $exists);
        }

        return parent::newPivot($parent, $attributes, $table, $exists);
    }

}
