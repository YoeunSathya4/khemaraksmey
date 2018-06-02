<?php

namespace App\Model\User;
use Illuminate\Database\Eloquent\Model;

class Permision extends Model
{
   
    protected $table = 'permisions';
    public function category(){
        return $this->belongsTo('App\Model\User\PermisionCategory', 'category_id');
    }
    public function users(){
        return $this->belongsToMany('App\Model\User\User', 'users_permisions');
    }
    public function permisionUsers(){
        return $this->hasMany('App\Model\User\UserPermision', 'permision_id');
    }
   
}
