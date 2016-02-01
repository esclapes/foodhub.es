<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShareItem extends Model
{
    protected $fillable = ['product_id', 'amount', 'price', 'unit'];

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
