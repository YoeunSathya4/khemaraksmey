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

class OrderController extends Controller
{
    
    public function index($locale) {
    	$id = Auth::guard('customer')->user()->id;

        $data = Model::find($id)->orders()->get();
    	return view('customer.order.index', ['locale'=>$locale,'data'=>$data]);
    }

    
}
