<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $price_value;
    protected $price_amount;
    protected $price_unit;
    protected $step_amount;
    protected $step_unit;

    protected $appends = [ 'price_value', 'price_amount', 'price_unit', 'step_amount', 'step_unit' ];


    public function __construct($attributes = array())
    {
        parent::__construct(array_diff_key($attributes, self::pricingDefaults())); // Eloquent

        $pricing = array_intersect_key($attributes, self::pricingDefaults());
        $this->setPricing($pricing);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('price_value', 'price_amount', 'price_unit', 'step_amount', 'step_unit')->withTimestamps();
    }

    public function lastOrder() {
        return $this->orders()->orderBy('id', 'desc')->first();
    }

    public function lastPricing() {
        return $this->lastOrder() ? $this->lastOrder()->pivot->toArray() : [];
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

    public function getPriceValueAttribute() {
        return $this->price_value;
    }

    public function getPriceAmountAttribute() {
        return $this->price_amount;
    }

    public function getPriceUnitAttribute() {
        return $this->price_unit;
    }

    public function getStepUnitAttribute() {
        return $this->step_unit ?: $this->price_unit;
    }

    public function getStepAmountAttribute() {
        return $this->step_amount ?: $this->price_amount;
    }

    public function getItemPrice($amount) {
        if ($this->getStepUnitAttribute() != $this->getPriceUnitAttribute()) {
            return null;
        }
        return  $amount * $this->getPriceValueAttribute() / $this->getPriceAmountAttribute();
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

    public function setPricing($values = [])
    {
        $pricing = array_merge(self::pricingDefaults(), $this->lastPricing(), $values);

        $this->price_value = $pricing['price_value'];
        $this->price_amount = $pricing['price_amount'];
        $this->price_unit = $pricing['price_unit'];
        $this->step_amount = $pricing['step_amount'];
        $this->step_unit = $pricing['step_unit'];

        return $this;

    }

}
