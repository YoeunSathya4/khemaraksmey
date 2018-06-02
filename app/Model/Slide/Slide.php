<?php

namespace App\Model\Slide;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slide extends Model
{
    use SoftDeletes;
    protected $table = 'slides';
    //protected $dates = ['deleted_at'];

   


}
