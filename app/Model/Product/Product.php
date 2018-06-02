<?php

namespace App\Model\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $table = 'products';
    //protected $dates = ['deleted_at'];

   	public function Category(){
        return $this->belongsTo('App\Model\Category\Category');
    }
    public function SubCategory(){
        return $this->belongsTo('App\Model\Category\SubCategory');
    }
    public function MainCategory(){
        return $this->belongsTo('App\Model\Category\SubSubCategory');
    }
}
