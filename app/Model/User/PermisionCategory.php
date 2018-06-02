<?php

namespace App\Model\User;
use Illuminate\Database\Eloquent\Model;

class PermisionCategory extends Model
{
   
    protected $table = 'permision_categories';
    public function permisions() {
        return $this->hasMany('App\Model\User\Permision', 'category_id');
    }
   
}
