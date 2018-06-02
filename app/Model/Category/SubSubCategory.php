<?php

namespace App\Model\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubSubCategory extends Model
{
   	use SoftDeletes;
    protected $table = 'sub_sub_categories';

    public function subCategories(){
        return $this->belongsTo('App\Model\Category\SubCategory');
    }

    public function products(){
        return $this->hasMany('App\Model\Product\Product');
    }
}
