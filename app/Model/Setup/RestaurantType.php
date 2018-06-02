<?php

namespace App\Model\Setup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RestaurantType extends Model
{
   	use SoftDeletes;
    protected $table = 'restaurant_types';
    protected $dates = ['deleted_at'];

    public function restaurants(){
    	return $this->hasMany('App\Model\Restaurant\Restaurant');
    }
 //    public function features(){
 //        return $this->belongsToMany('App\Model\Setup\Feature', 'features_types');
 //    }
	// public function detailTypes(){
 //    	return $this->hasMany('App\Model\Setup\DetailType');
 //    }
 //     public function details(){
 //        return $this->belongsToMany('App\Model\Setup\Detail', 'details_types');
 //    }
	// public function properties(){
 //    	return $this->hasMany('App\Model\Property\Property');
 //    }
   
}
