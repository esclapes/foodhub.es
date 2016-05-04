<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShareItem extends Model
{
    protected $fillable = ['product_id', 'amount'];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function share() {
        return $this->belongsTo(Share::class);
    }

    public function order() {
        return $this->share->order();
    }
}
