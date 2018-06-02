<?php

namespace App\Http\Controllers\CP\Customer;

use Auth;
use Session;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\CamCyber\FileUploadController as FileUpload;
use App\Http\Controllers\CamCyber\FunctionController;

use App\Model\Customer\Customer as Model;
use App\Model\Order\Order as Order;
use App\Model\User\Role as Role;

class CustomerController extends Controller
{
    protected $route;
    public function __construct(){
        $this->route = "cp.customer.customer";
    }
    function validObj($id=0){
        $data = Model::find($id);
        if(empty($data)){
           echo "Invalide Object"; die;
        }
    }

    public function index(){

        $data = Model::select('*');
        $limit      =   intval(isset($_GET['limit'])?$_GET['limit']:10); 
        $key       =   isset($_GET['key'])?$_GET['key']:"";
        $phone       =   isset($_GET['phone'])?$_GET['phone']:"";
        $email       =   isset($_GET['email'])?$_GET['email']:"";
        $from=isset($_GET['from'])?$_GET['from']:"";
        $till=isset($_GET['till'])?$_GET['till']:"";
        $appends=array('limit'=>$limit);
        if( $key != "" ){
            $data = $data->where('name', 'like', '%'.$key.'%');
            $appends['key'] = $key;
        }
        if( $phone != "" ){
            $data = $data->where('phone', 'like', '%'.$phone.'%');
            $appends['phone'] = $phone;
        }
        if( $email != "" ){
            $data = $data->where('email', 'like', '%'.$email.'%');
            $appends['email'] = $email;
        }
        if(FunctionController::isValidDate($from)){
            if(FunctionController::isValidDate($till)){
                $appends['from'] = $from;
                $appends['till'] = $till;

                $from .=" 00:00:00";
                $till .=" 23:59:59";

                $data = $data->whereBetween('created_at', [$from, $till]);
            }
        }
        $data= $data->orderBy('created_at', 'DESC')->paginate($limit);
        if(!empty($data)){
            return view($this->route.'.index', ['route'=>$this->route, 'data'=>$data,'appends'=>$appends]);
        }else{
            return view('errors.404');
        }
    }
   
    public function showCreateForm(){
        return view($this->route.'.create', ['route'=>$this->route]);
    }
    public function store(Request $request) {
        // $position_id = $request->input('position_id');
        // $status = 0;
        //$is_ip_validated = 1;
        $data = array(
                    'name' =>   $request->input('name'),
                    'phone' =>  $request->input('phone'), 
                    'email' =>  $request->input('email'),
                    
                    'address' =>  $request->input('address'),
                    'location' =>  $request->input('location')
                );
        Session::flash('invalidData', $data );
        Validator::make(
        	            $request->all(), 
			        	[
						    'name' => 'required',
                            'phone' => [
                                            'required',
                                            Rule::unique('customers')
                                        ],
                            'email' => [
                                            'required',
                                            'email',
                                            Rule::unique('customers')
                                        ],
                            'image' => [
                                            'required',
                                            'mimes:jpeg,png',
                            ],
						], 

                        [
                            'email.unique' => 'New new email address :'.$request->input('email').' can not be used. It has already been taken.',
                            'image.dimensions' => 'Please provide valide image dimensions 200x165.',
                        ])->validate();
        
        
    
        $image = FileUpload::uploadFile($request, 'image', 'uploads/customer');
        if($image != ""){
            $data['image'] = $image; 
        }

		$id=Model::insertGetId($data);

        Session::flash('msg', 'Data has been Created!');
		return redirect(route($this->route.'.edit', $id));
    }

    public function showEditForm($id = 0){
        $this->validObj($id);
        $data = Model::find($id);
        
        return view($this->route.'.edit', ['route'=>$this->route, 'id'=>$id, 'data'=>$data]);
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
                            'image' => [
                                            'sometimes',
                                            'required',
                                            'mimes:jpeg,png',
                                            Rule::dimensions()->width(200)->height(165),
                            ],
						],
                        [
                            'email.unique' => 'New new email address :'.$request->input('email').' can not be used. It has already been taken.',
                            'image.dimensions' => 'Please provide valide image dimensions 200x165.',
                        ])->validate();

		
		$data = array(
                    'name' =>   $request->input('name'),
                    'phone' =>  $request->input('phone'), 
                    'email' =>  $request->input('email'),
                    'password' => bcrypt($request->input('password')),
                    'address' =>  $request->input('address'),
                    'location' =>  $request->input('location')
                );
        
        
        $image = FileUpload::uploadFile($request, 'image', 'uploads/customer');
        if($image != ""){
            $data['image'] = $image; 
        }
		//echo $picture; die;
        Model::where('id', $id)->update($data);
        Session::flash('msg', 'Data has been updated!' );
        return redirect()->back();
	}

    public function updatePassword(Request $request){
        $data = array(
                    'password' => bcrypt($request->input('password'))
                );
        $id = $request->input('id');
         Model::where('id', $id)->update($data);
        return response()->json([
            'status' => 'success',
            'msg' => 'Password has been updated.'
        ]);
    }

    function updateEmail(Request $request){
      $id   = $request->input('id');
      $data = array('is_email_verified' => $request->input('email'));
      Model::where('id', $id)->update($data);
      return response()->json([
          'status' => 'success',
          'msg' => 'Customer Email Verify has been updated.'
      ]);
    }


    function updatePhone(Request $request){
      $id   = $request->input('id');
      $data = array('is_phone_verified' => $request->input('phone'));
      Model::where('id', $id)->update($data);
      return response()->json([
          'status' => 'success',
          'msg' => 'Customer Phone Verify has been updated.'
      ]);
    }
  
    public function destroy($id){
        Model::where('id', $id)->update(['deleter_id' => Auth::id()]);
        Model::where('id', $id)->delete();
        Session::flash('msg', 'Data has been delete!' );
        return response()->json([
            'status' => 'success',
            'msg' => 'User has been deleted'
        ]);
    }

    public function logs($id=0){
        $this->validObj($id);
        
        $dataLog = Model::find($id)->logs();
        $limit=intval(isset($_GET['limit'])?$_GET['limit']:10); 
        $from=isset($_GET['from'])?$_GET['from']:"";
        $till=isset($_GET['till'])?$_GET['till']:"";

        if($limit <= 0 || $limit > 100){
            $limit = 10;
        }

        $appends=array('limit'=>$limit);
       
        if(FunctionController::isValidDate($from)){
            if(FunctionController::isValidDate($till)){
                $appends['from'] = $from;
                $appends['till'] = $till;

                $from .=" 00:00:00";
                $till .=" 23:59:59";

                $dataLog = $dataLog->whereBetween('created_at', [$from, $till]);
            }
        }
       
        $logs= $dataLog->orderBy('created_at', 'DESC')->paginate($limit);
        return view($this->route.'.logs', ['route'=>$this->route, 'id'=>$id, 'data'=>$logs, 'appends'=>$appends]);
    }

    public function orders($id=0){
        $this->validObj($id);
        
        $data = Model::find($id)->orders()->get();
        
        return view($this->route.'.orders', ['route'=>$this->route, 'id'=>$id, 'data'=>$data]);
    }

   public function orderData(Request $request){
        $id = $request->input('id');

        $data = Order::find($id);
        
        $details = Order::find($id)->details;
        //dd($details);
        return view($this->route.'.order-data', ['route'=>$this->route, 'data'=>$data,'details'=>$details]);
    }
    

}
