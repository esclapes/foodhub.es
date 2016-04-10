<?php

namespace App;

use Mpociot\Teamwork\TeamworkTeam;

class Group extends TeamworkTeam
{

  public function __construct(array $attributes = [])
  {
    parent::__construct($attributes);
    if(empty($attributes['slug']) && !empty($attributes['name'])) {
      $attributes['slug'] = \Slugify::slugify($attributes['name']);
    }
  }

  public function products() {
    return $this->hasMany(Product::class);
  }

  public function orders()
  {
    return $this->hasMany(Order::class);
  }

  public function addProducts($products) {

    return $this->products()->saveMany($products);

  }
}
