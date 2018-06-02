<?php

namespace App\Model\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    protected $table = 'orders';
    protected $dates = ['deleted_at'];

    public function details() {
        return $this->hasMany('App\Model\Order\OrderDetails');
    }

    public function location(){
        return $this->belongsTo('App\Model\Setup\Location');
    }
    public function customer(){
        return $this->belongsTo('App\Model\Customer\Customer');
    }
    // public function categories(){
    //     return $this->belongsToMany('App\Model\Setup\Category', 'restaurants_categories');
    // }

    // public function r_categories(){
    //     return $this->hasMany('App\Model\Restaurant\RestaurantCategory');
    // }

    // public function menus(){
    //     return $this->hasMany('App\Model\Menu\Menu');
    // }
}