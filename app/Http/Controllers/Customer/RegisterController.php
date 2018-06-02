<?php

namespace App\Http\Controllers\Customer;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rule;
use Session ;

use App\Model\Customer\Customer as Customer;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

   /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'customer/en/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
    }

    public function showRegisterForm($locale ){
        return view('customer.auth.register',['locale'=>$locale]);
    }

    public function register(Request $request, $locale){
        $this->validator($request->all())->validate();

        event(new Registered($customer = $this->create($request->all())));
        $this->guard()->login($customer);

        return $this->registered($request, $customer) ?: redirect($this->redirectPath());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'phone' => [
                            'required',
                            'regex:/(^[0][0-9].{7}$)|(^[0][0-9].{8}$)/',
                            'unique:customers'

                        ],
            'email' => 'required|email|max:255|unique:customers',
            'password' => 'required|min:6|confirmed',
        ], 
        [
            'email.unique' => 'The email address has already existed. Please try new one.',
            'phone.regex' => 'Please enter correct phone number format. E.g 0965416704'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        Session::flash('msg', 'Your account has been created. Please log in. ' );
        
        return Customer::create(
            [
                'name' => $data['name'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
            ]
        );
    }
    protected function guard()
    {
        return Auth::guard('customer');
    }


}
