<?php

namespace App\Http\Controllers\Customer;



use Auth;
use Session;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\CamCyber\FileUploadController as FileUpload;
use App\Http\Controllers\CamCyber\FunctionController;

use App\Model\Customer\Customer as Model;

use App\Model\Setup\Category as Category;
class ProfileXController extends Controller
{
    
    public function index($locale) {
    	$customer = Auth::guard('customer')->user();
        //dd($mentor);
    	return view('customer.profile', ['locale'=>$locale,'data'=>$customer]);
    }

    public function update(Request $request){
        $id = $request->input('id');
        Validator::make(
                        $request->all(), 
                        [
                            'name' => 'required',
                            'phone' => [
                                            'required',
                                            Rule::unique('customers')->ignore($id)
                                        ],
                            'email' => [
                                            'required',
                                            'email',
                                            Rule::unique('customers')->ignore($id)
                                        ],
                            
                        ],
                        [
                            'email.unique' => 'New new email address :'.$request->input('email').' can not be used. It has already been taken.',
                            'image.dimensions' => 'Please provide valide image dimensions 200x165.',
                        ])->validate();

        
        $data = array(
                    'name' =>   $request->input('name'),
                    'location' =>   $request->input('location'),
                    'address' =>   $request->input('address'),
                    'phone' =>  $request->input('phone'), 
                    'email' =>  $request->input('email')
                );
        
        $image = FileUpload::uploadFile($request, 'avatar', 'uploads/customer');
        if($image != ""){
            $data['image'] = $image; 
        }
        //echo $picture; die;
        Model::where('id', $id)->update($data);
        Session::flash('msg', 'Data has been updated!' );
        return redirect()->back();
    }
    
}
