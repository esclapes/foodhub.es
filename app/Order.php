<?php

namespace App;

use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class Order extends Model
{
    const OPEN = 'open';
    const CLOSED = 'closed';
    const CREATED = 'crated';
    const PENDING = 'pending';
    const ARCHIVED = 'archived';

    protected $fillable = ['title', 'description', 'closin_at'];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_prices')->withPivot('id', 'price_value', 'price_amount', 'price_unit', 'step_amount', 'step_unit')->withTimestamps();
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
     * @param $product
     */
    public function addProduct($product)
    {

        if ( !($product instanceof Product) ) {
            throw new InvalidArgumentException;
        }

        return $this->products()->save($product);

    }

    /**
     * @param array $product_prices
     * @return array
     */
    public function addProducts($product_prices)
    {

        if ( !is_array($product_prices) && !($product_prices instanceof Collection) ) {
            throw new InvalidArgumentException;
        }

        return $this->products()->saveMany($product_prices);

    }

    /**
     * @param array $items an array of share items with the product id as key and the amount as value
     *                     like [$id => $value, ...]
     * @return array of ShareItems
     */
    public function getShareItems(array $items)
    {
        // remove
        $items = array_filter($items);
        $keys = collect(array_keys($items));

        return $keys->map(function ($key) use ($items) {
            return $this->getShareItem($key, $items[$key]);
        });

    }


    /**
     * @param $id the id of a product
     * @param $amount the amount of a given product
     *
     * @return ShareItem
     *
     * @throws ModelNotFoundException
     */
    public function getShareItem ($id, $amount) {

        $product = $this->products()->findOrFail($id);

        $newItem = [
            'product_id' => $product->id,
            'amount' => $amount,
        ];
        return new ShareItem($newItem);
    }


    public function newPivot(Model $parent, array $attributes, $table, $exists)
    {
        if ($parent instanceof Product) {
            return new ProductPrice($parent, $attributes, $table, $exists);
        }

        return parent::newPivot($parent, $attributes, $table, $exists);
    }
}
