<?php

namespace App\Model\Setup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
   	use SoftDeletes;
    protected $table = 'locations';
    protected $dates = ['deleted_at'];
 //    public function featureTypes(){
 //    	return $this->hasMany('App\Model\Setup\FeatureType');
 //    }
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
