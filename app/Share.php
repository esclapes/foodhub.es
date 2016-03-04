<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
    protected $fillable = ['email', 'phone', 'comments'];


    public function items () {
        return $this->hasMany(ShareItem::class);
    }

}
