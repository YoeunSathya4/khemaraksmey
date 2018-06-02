<?php

namespace App\Model\Restaurant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RestaurantCategory extends Model
{
   	use SoftDeletes;
    protected $table = 'restaurants_categories';

    public function restaurant(){
    	return $this->belongsTo('App\Model\Restaurant\Restaurant','category_id');
    }

    public function category(){
    	return $this->belongsTo('App\Model\Setup\Category','category_id');
    }
}
