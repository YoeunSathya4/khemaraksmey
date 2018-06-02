<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\Model\Property\P_Units as Unit;
//use App\Model\Website\Icon as Icon;
use App\Model\Image\Image as Image;
use App\Model\Website\Adv as Adv;
class ContactController extends FrontendController
{
    
    public function index($locale) {
        return view('frontend.contact',['locale'=>$locale]);
    }

    public function submitContact(Request $request , $locale = "en")
    {
        $defaultData = $this->defaultData($locale);
        $data = array(
                    'name' =>   $request->input('name'),
                    'phone' =>  $request->input('phone'),
                    'email' =>  $request->input('email'),
                    'subject' =>  $request->input('subject'),
                    'message' =>  $request->input('message') 
                );
        //dd($data);
        Session::flash('invalidData', $data );
         Validator::make(
                        $request->all(), 
                        [
                            'name' => 'required|min:3|max:30',
                            'subject' => 'required',
                            'email' => 'email',
                            'message' => 'required|max:255',
                            'g-recaptcha-response' => 'required',
                        ], 

                        [
                            
                        ])->validate();
        
        // Mail::to('yoeunsathya4@gmail.com')->send(new NewUserWelcome($data));
        // $client_email = $request->input('email');
        // Mail::to($client_email)->send(new ReplyBackToClients($data)); 
        $id=Message::insertGetId($data);
        Session::flash('msg', __('contact_us.contact-successful-sent') );
        return redirect(route('contact-us', ['locale'=>$locale]));
    }
}
