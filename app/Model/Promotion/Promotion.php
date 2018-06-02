<?php

namespace App\Model\Promotion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promotion extends Model
{
    use SoftDeletes;
    protected $table = 'promotions';
    //protected $dates = ['deleted_at'];

   


}
