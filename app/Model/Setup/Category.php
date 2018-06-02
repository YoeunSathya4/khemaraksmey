<?php

namespace App\Model\Setup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
   
    use SoftDeletes;
    protected $table = 'categories';

    public function restaurants(){
        return $this->belongsToMany('App\Model\Restaurant\Restaurant', 'restaurants_categories');
    }
    public function r_categories(){
        return $this->hasMany('App\Model\Restaurant\RestaurantCategory');
    }

    public function menus(){
        return $this->belongsToMany('App\Model\Menu\Menu', 'menus_categories');
    }
    public function m_categories(){
        return $this->hasMany('App\Model\Menu\MenuCategory');
    }
}
