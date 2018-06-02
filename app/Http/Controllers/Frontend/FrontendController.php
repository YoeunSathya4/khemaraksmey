<?php

namespace App\Http\Controllers\Frontend;

use Session;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

use App\Model\Newsletter as Newsletter;

class FrontendController extends Controller
{
  	
	public $defaultData = array();
    public function __construct(){
        
    }

    public function defaultData(){
        //Slide Data
        //$this->defaultData['slides'] = Slide::where('is_published', 1)->get();
        //Partner Data
        //$this->defaultData['partners'] = Partnership::where(['is_published'=>1, 'type_id'=>1])->get();
        return $this->defaultData;
    }
    
    public function submitNewsletter(Request $request , $locale = "en")
    {
        $now        = date('Y-m-d H:i:s');
        $defaultData = $this->defaultData($locale);

        $data = array(
                    'email' =>  $request->input('email'),
                    'created_at' => $now
                );
         Session::flash('invalidData', $data );
         Validator::make(
                        $request->all(), 
                        [
                            'email' => 'email',
                        ])->validate();
        
        //Mail::to('koeun@gmail.com')->send(new NewUserWelcome($data));
        //$client_email = $request->input('email');
        //Mail::to($client_email)->send(new ReplyBackToClients($data)); 
        $id=Newsletter::insertGetId($data);
        Session::flash('msg', __('contact_us.contact-successful-sent') );
        //return redirect(route('home', ['locale'=>$locale]));
    }
}
