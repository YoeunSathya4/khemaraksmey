<?php

namespace App\Model\Menu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuCategory extends Model
{
   	use SoftDeletes;
    protected $table = 'menus_categories';
    protected $dates = ['deleted_at'];

    public function manu(){
    	return $this->belongsTo('App\Model\Menu\Menu');
    }
   	public function category(){
    	return $this->belongsTo('App\Model\Setup\Category');
    }
    
}
