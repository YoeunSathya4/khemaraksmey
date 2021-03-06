<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CamCyber\AgentController as Agent;
use App\Http\Controllers\CamCyber\IpAddressController as IpAddress;

use App\Model\User\Log;


use Hash;
use Auth;
use Session ;


class AuthController extends Controller {
    
   
    public function login () {
        if (!Auth::guard('customer')->check()) 
            return view('customer/auth.login');
        else 
            return redirect()->route('customer.customer.profile');
    }   

    protected function authenticate(Request $request) {

        $password = $request->input('password');
        $username = $request->input('username');
        $remember = 0;
        if($request->input('remember') == 'on'){
            $remember = 1;
        }
        
        $credentials['password']    = $password;
        $credentials['active']      = 1;
        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $username;
        }else if(preg_match("/(^[00-9].{8}$)|(^[00-9].{9}$)/",$username)){
            $credentials['phone'] = $username;
        }else{
            Session::flash ('flashmessage', trans('Invalide Username')) ;
            return redirect()->route('customer.auth.login');
        }

        if (Auth::guard('customer')->attempt($credentials, $remember)) {
            $agent      = new Agent;
            $info       = $agent::showInfo();
            $ipAddress  = new IpAddress;
            $ip         = $ipAddress::getIP(); 
            //Save Logs
            $log = new Log;
            $log->user_id   = Auth::user('user')->id;
            $log->ip        = $ip;
            $log->os        = $info['os'];
            $log->broswer   = $info['browser'];
            $log->version   = $info['version'];
            $log->save();
            return redirect()->route('user.profile');
        } else {
            Session::flash ('flashmessage', trans('Username Password Not Correct')) ;
            return redirect()->route('customer.auth.login');
        }
    }
    public function logout () {
        Auth::guard('customer')->logout () ;
        return redirect()->route('customer.auth.login');
    }

    public function reset(){
        return view('customer/auth.reset-password');
    }
    public function makeResetCode(Request $request){
        $username = $request->input('username');
        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $username;
        }else{
            Session::flash ('flashmessage', trans('Invalide E-mail address')) ;
            return redirect()->route('customer.auth.reset-password');
        }
    }
    public function compareResetCode(){
        return view('customer/auth.login');
    }
    public function changePassword(){
        return view('customer/auth.login');
    }
    public function SubmitChangePassword(){
        return view('customer/auth.login');
    }

  
}