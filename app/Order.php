<?php

namespace App;

use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Order extends Model
{
    const OPEN = 'open';
    const CLOSED = 'closed';
    const CREATED = 'crated';
    const PENDING = 'pending';
    const ARCHIVED = 'archived';

    protected $fillable = ['title', 'description', 'closin_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function priceList()
    {
        return $this->hasMany(ProductPrice::class);
    }

    public function shares() {
        return $this->hasMany(Share::class);
    }
    /**
     * Scope a query to only include open orders.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOpen($query)
    {

        return $query->where('status', Order::OPEN)->get();

    }

    /**
     * @param $product_price
     */
    public function addProduct($product_price)
    {

        if ( !($product_price instanceof ProductPrice) ) {
            throw new InvalidArgumentException;
        }

        return $this->priceList()->save($product_price);

    }

    /**
     * @param array $product_prices
     */
    public function addProducts($product_prices)
    {

        if ( !is_array($product_prices) && !($product_prices instanceof Collection) ) {
            throw new InvalidArgumentException;
        }

        return $this->priceList()->saveMany($product_prices);

    }

    public function getShareItems(array $items)
    {
        $items = collect(array_filter($items));

        $products = $items->map(function ($amount, $id) {
            return $this->getShareItem($amount, $id);
        });

        return $products;
    }

    public function getShareItem ($amount, $id) {

        $product = $this->products()->find($id);

        $newItem = [
            'product_id' => $id,
            'amount' => $amount,
            'price' => $product->getItemPrice($amount),
            'unit' => $product->pivot->step_unit
        ];
        return new ShareItem($newItem);
    }
}
