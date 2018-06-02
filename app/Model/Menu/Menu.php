<?php

namespace App\Model\Menu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
   	use SoftDeletes;
    protected $table = 'menus';
    protected $dates = ['deleted_at'];

    public function extras(){
        return $this->hasMany('App\Model\Menu\MenuExtra');
    }
    public function sizes(){
    	return $this->hasMany('App\Model\Menu\MenuSize');
    }
    public function images(){
    	return $this->hasMany('App\Model\Menu\MenuImage');
    }
    public function restaurant(){
        return $this->belongsTo('App\Model\Restaurant\Restaurant');
    }
    public function category(){
        return $this->belongsTo('App\Model\Setup\Category', 'category_id');
    }
    public function orders(){
        return $this->hasMany('App\Model\Order\OrderDetail', 'menu_id');
    }
    // public function categories(){
    //     return $this->belongsToMany('App\Model\Setup\Category', 'menus_categories');
    // }
    // public function m_categories(){
    //     return $this->hasMany('App\Model\Menu\MenuCategory');
    // }
}
