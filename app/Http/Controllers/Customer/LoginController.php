<?php

namespace App\Http\Controllers\Customer;

use Auth;
use Session ;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\CamCyber\AgentController as Agent;
use App\Http\Controllers\CamCyber\IpAddressController as IpAddress;

use App\Model\User\Log;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'customer/en/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        //$this->middleware('guest:customer', ['except' => 'logout']);
    }

    function showLoginForm($locale){

        return view('customer.auth.login',['locale'=>$locale]);
    }

    protected function credentials(Request $request)
    {
        $credentials = $request->only($this->username(), 'password'); 
        //$credentials['status'] = 1; 
        return $credentials;
    }

   
    //Create Logs
    // protected function authenticated(Request $request, $user){
    //     //Log Information
    //     $agent      = new Agent;
    //     $info       = $agent::showInfo();
    //     $ipAddress  = new IpAddress;
    //     $ip         = $ipAddress::getIP(); 
    //     //Save Logs
    //     $log = new Log;
    //     $log->user_id   = $user->id;
    //     $log->ip        = $ip;
    //     $log->os        = $info['os'];
    //     $log->broswer   = $info['browser'];
    //     $log->version   = $info['version'];
    //     $log->save();
        
    // }
     protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard('customer')->user())
                ?: redirect()->intended($this->redirectPath());
    }


    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [$this->username() => trans('auth.failed')];

        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }

        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    public function logout(Request $request,$locale){
        $this->guard('customer')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->route('customer.login',['locale'=>$locale]);
    }
    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('customer');
    }
}
