<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;


class AccessController extends Controller {
   
    public function showUnaccessForm() {
       return view('user.auth.unaccess');
    }   

   
}