<?php

namespace App\Model\Restaurant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restaurant extends Model
{
   	use SoftDeletes;
    protected $table = 'restaurants';
    protected $dates = ['deleted_at'];

    public function r_type(){
        return $this->belongsTo('App\Model\Setup\RestaurantType','type_id');
    }
    public function contact() {
        return $this->hasOne('App\Model\Restaurant\RestaurantContact');
    }

    public function categories(){
        return $this->belongsToMany('App\Model\Setup\Category', 'restaurants_categories');
    }

    public function r_categories(){
    	return $this->hasMany('App\Model\Restaurant\RestaurantCategory');
    }

    public function menus(){
        return $this->hasMany('App\Model\Menu\Menu');
    }
}
