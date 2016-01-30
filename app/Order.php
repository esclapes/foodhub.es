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


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
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
     * @param array $products
     */
    public function addProducts($products)
    {

        if ( !is_array($products) && !($products instanceof Collection) ) {
            throw new InvalidArgumentException;
        }

        return $this->products()->saveMany($products);

    }
}
