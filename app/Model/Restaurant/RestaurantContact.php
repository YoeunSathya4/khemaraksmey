<?php

namespace App\Model\Restaurant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RestaurantContact extends Model
{
   	use SoftDeletes;
    protected $table = 'restaurant_contact';

    public function restaurant(){
    	return $this->hasOne('App\Model\Restaurant\Restaurant');
    }
}