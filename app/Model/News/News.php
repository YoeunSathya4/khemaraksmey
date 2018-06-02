<?php

namespace App\Model\News;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use SoftDeletes;
    protected $table = 'news';
    //protected $dates = ['deleted_at'];

   


}
