<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    public function __construct($attributes = array())
    {
        parent::__construct(array_diff_key($attributes, ProductPrice::pricingDefaults())); // Eloquent

        $pricing = array_intersect_key($attributes, ProductPrice::pricingDefaults());
        $this->setPrice($pricing);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders()
    {
        return $this->hasManyThrough(Order::class, ProductPrice::class);
    }

    public function prices() {
        return $this->hasMany(ProductPrice::class);
    }

    public function lastOrder() {
        return $this->orders()->orderBy('id', 'desc')->first();
    }

    public function lastPricing() {
        return $this->prices()->orderBy('id', 'desc')->first() ? $this->prices()->orderBy('id', 'desc')->first()->toArray() : [];
    }

    public function getPricingAttribute()
    {
        return [
            'price_value' => $this->price_value,
            'price_amount' => $this->price_amount,
            'price_unit' => $this->price_unit,
            'step_unit' => $this->step_unit,
            'step_amount' => $this->step_amount
        ];
    }

    public function setPrice($values = [])
    {
        $pricing = array_merge(ProductPrice::pricingDefaults(), $this->lastPricing(), $values);

        if(empty($pricing['order_id'])) {
            $pricing['order_id'] = $this->lastOrder()->id;
        }

        $price = new ProductPrice($pricing);

        return $this->prices()->save($price);

    }

}
