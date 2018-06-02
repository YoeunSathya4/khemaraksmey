<?php

namespace App\Model\Customer;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
   
    protected $table = 'customer_logs';
    
    public function customer(){
        return $this->belongsTo('App\Model\Customer\Customer', 'customer_id');
    }
   
}
