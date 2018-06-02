<?php

namespace App\Model\Menu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuImage extends Model
{
   	use SoftDeletes;
    protected $table = 'menu_images';
    protected $dates = ['deleted_at'];
    public function menu(){
    	return $this->belongsTo('App\Model\Menu\Menu');
    }

   
}
