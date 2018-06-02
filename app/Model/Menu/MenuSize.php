<?php

namespace App\Model\Menu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuSize extends Model
{
   	use SoftDeletes;
    protected $table = 'menu_sizes';
    protected $dates = ['deleted_at'];
    
    public function menu(){
    	return $this->belongsTo('App\Model\Menu\Menu');
    }

   
}
