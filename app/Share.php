<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
    protected $fillable = ['email', 'phone', 'comments'];


    public function items () {
        return $this->hasMany(ShareItem::class);
    }

    function getTotalAttribute() {
        $total = collect($this->items)->reduce(function($carry, $item) {
            return $carry + $item->price;
        }, 0);
        return number_format($total, 2);
    }

}
