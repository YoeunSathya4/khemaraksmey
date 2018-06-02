<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Log;
use Illuminate\Mail\Message;
use Session;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */
  
    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
    }
    
    // protected function broker(){
    //     return Password::broker('user');
    // }
    function showLinkRequestForm($locale){
        return view('customer.auth.forgot-password', ['locale'=>$locale]);
    }
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        
        $response = $this->broker()->sendResetLink($request->only('email'));
        
        return $response == Password::RESET_LINK_SENT
                    ? $this->sendResetLinkResponse($response)
                    : $this->sendResetLinkFailedResponse($request, $response);
    }
    protected function sendResetLinkResponse($response)
    {
        Session::flash('msg', 'We have send you an email. Please read instruction there. Thanks.' );
        return back()->with('status', trans($response));
    }
    protected function guard()
    {
        return Auth::guard('customer');
    }
    protected function broker()
    {
        return Password::broker('customers');
    }
}
