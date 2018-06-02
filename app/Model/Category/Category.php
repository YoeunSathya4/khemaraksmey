<?php

namespace App\Model\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
   	use SoftDeletes;
    protected $table = 'categories';

    public function subCategories(){
        return $this->hasMany('App\Model\Category\SubCategory');
    }

    public function products(){
        return $this->hasMany('App\Model\Product\Product');
    }
}
