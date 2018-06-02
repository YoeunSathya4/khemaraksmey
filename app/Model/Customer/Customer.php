<?php

namespace App\Model\Customer;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\CustomerResetPasswordNotification;

class Customer extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone','image','address','location',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomerResetPasswordNotification($token));
    }

    public function logs() {
        return $this->hasMany('App\Model\Customer\Log', 'customer_id');
    }
    public function orders() {
        return $this->hasMany('App\Model\Order\Order', 'customer_id');
    }
    // public function records() {
    //     return $this->hasMany('App\Model\Mailing\Record', 'creator_id');
    // }
    // public function userPermisions() {
    //     return $this->hasMany('App\Model\User\UserPermision');
    // }
    // public function staffProperties() {
    //     return $this->hasMany('App\Model\Property\PropertyStaff', 'staff_id');
    // }

}
