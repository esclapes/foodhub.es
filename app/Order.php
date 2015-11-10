<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = ['name', 'description', 'closing_at'];

    protected $dates = ['updated_at', 'created_at', 'deleted_at', 'closing_at'];

    protected $dateFormat = 'd/m/Y H:i';

    protected $softDelete = true;

    /**
     * Inverse relationship with the owner user
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function owner()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * The products available to buy in this order
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('price_value', 'price_amount', 'price_unit', 'order_amount', 'order_unit')->withTimestamps();
    }

    /**
     * The order shares that have been placed for this order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shares()
    {
        return $this->hasMany(OrderShare::class);
    }

    /**
     * The users that have a share in this order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function shareholders()
    {
        return $this->hasManyThrough(User::class, App\OrderShare::class);
    }
}
