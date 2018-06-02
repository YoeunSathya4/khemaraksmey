<?php

namespace App\Http\Controllers\CP\Order;

use Auth;
use Session;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\CamCyber\FileUploadController as FileUpload;
use App\Http\Controllers\CamCyber\FunctionController;

use App\Model\Order\Order as Model;
use App\Model\Order\OrderDetails as OrderDetails;
use App\Model\Customer\Customer as Customer;
use App\Model\User\User as User;
use App\Model\Product\Product as Product;
//use App\Model\Menu\MenuSize as MenuSize;


class OrderController extends Controller
{
    protected $route; 
    public function __construct(){
        $this->route = "cp.order";
    }
    function validObj($id=0){
        $data = Model::find($id);
        if(empty($data)){
           echo "Invalide Object"; die;
        }
    }

    public function newOder(){
        $data = Model::select('*')->where('is_success',1)->orderBy('created_at', 'DESC')->get();
        return view($this->route.'.new_order', ['route'=>$this->route, 'data'=>$data]);
    }
    public function orderData(Request $request){
        $id = $request->input('id');

        $data = Model::find($id);
        
        $details = Model::find($id)->details;
        //dd($details);
        return view($this->route.'.order-data', ['route'=>$this->route, 'data'=>$data,'details'=>$details]);
    }
   
    function searchProduct(){
       
        $data = Product::where(function ($query) {
                $key = $_GET['key'];
                $query->where('en_name', 'like', '%'.$key.'%');
            })->limit(50)->orderBy('id', 'DESC')->get();
        
        
        return view($this->route.'.products', ['route'=>$this->route,'data'=>$data]);
    }
    function searchCustomer(){
        $data = Customer::where(function ($query) {
                $key = $_GET['key'];
                $query->where('name', 'like', '%'.$key.'%');
            })->orderBy('id', 'DESC')->get();
        return view($this->route.'.customer-data', ['route'=>$this->route,'data'=>$data]);
    }
    public function allOder(){
        //$types = Type::get();
        //$restaurants = Restaurant::get();

        $data = Model::select('*');
        $limit      =   intval(isset($_GET['limit'])?$_GET['limit']:10); 
        $key       =   isset($_GET['key'])?$_GET['key']:"";
    
        $from=isset($_GET['from'])?$_GET['from']:"";
        $till=isset($_GET['till'])?$_GET['till']:"";
        $appends=array('limit'=>$limit);
        if( $key != "" ){
            $data = $data->where('address', 'like', '%'.$key.'%')->orWhere('delivery_time', 'like', '%'.$key.'%');
            $appends['key'] = $key;
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
        
        return view($this->route.'.all_order', ['route'=>$this->route, 'data'=>$data, 'appends'=>$appends]);
    }

     public function orderForm(Request $request){
        $customers      = Customer::get();
        $deliveries     = User::where('position_id',2)->get();

        $carts =  array();

        if($request->session()->has('carts')){
          $carts = $request->session()->get('carts');
          //return view($this->route.'.confirm', ['route'=>$this->route,'carts'=>$carts]);
          //return redirect(route($this->route.'.confirm'));
        }
        
        return view($this->route.'.order_form', ['route'=>$this->route,'carts'=>$carts,'customers'=>$customers,'deliveries'=>$deliveries]);

        
    }

    function addToCart(Request $request){
       $carts =  array();

       if($request->session()->has('carts')){
          $carts = $request->session()->get('carts');
          //return view($this->route.'.confirm', ['route'=>$this->route,'carts'=>$carts]);
          //return redirect(route($this->route.'.confirm'));
       }
       $id = $request->input('id');
       $qty = $request->input('qty');
       
       $found=0;
       if(!empty($carts)){
            for($i=0;$i<count($carts); $i++){
                if($carts[$i]['id']==$id){
                    //echo $carts[$i]['qty']; die;
                    $carts[$i]['qty']=$qty+$carts[$i]['qty'];
                    $found=1;
                }
            }

        }

        if($found==0){
            $data = array(
                    'id' =>   $request->input('id'),
                    'name' =>   $request->input('name'),
                    'product_id' =>   $request->input('product_id'),
                    'qty' =>   $request->input('qty'),
                    'price' =>   $request->input('price'),
                    'instruction' => $request->input('instruction')
                );
            $carts[] = $data;
        }

        

        

        $request->session()->put('carts', $carts);
        //print_r($carts);
        //$request->session()->pull('carts', 'default');
        return view($this->route.'.product-cart', ['route'=>$this->route,'carts'=>$carts]);

    }
    function removeItem(Request $request){
        $id = $request->input('id');
        $carts =  array();
        if($request->session()->has('carts')){
          $carts = $request->session()->get('carts');
        }
        if(!empty($carts)){
            for($i=0;$i<count($carts);$i++){
                if($carts[$i]['id']==$id){
                    array_splice($carts, $i, 1);
                }   
            }
        }

        $request->session()->put('carts', $carts);
        return view($this->route.'.product-cart', ['route'=>$this->route,'carts'=>$carts]);
    }
    function clearCart(Request $request){
        $carts =  array();
        if($request->session()->has('carts')){
          $carts = $request->session()->get('carts');
        }

        $request->session()->pull('carts', 'default');

        //return json();
    }

    function orderSession(Request $request){
       $carts =  array();

       if($request->session()->has('carts')){
          $carts = $request->session()->get('carts');
          //return view($this->route.'.confirm', ['route'=>$this->route,'carts'=>$carts]);
          //return redirect(route($this->route.'.confirm'));
       }

        $request->session()->put('carts', $carts);
        //print_r($carts);
        //$request->session()->pull('carts', 'default');
        return view($this->route.'.product-cart', ['route'=>$this->route,'carts'=>$carts]);

    }
    function addNewCustomer(Request $request){
        $user_id  = Auth::id();
        $now      = date('Y-m-d H:i:s');
        $customer_name      = $request->input('customer_name');
        $customer_phone     = $request->input('customer_phone');
        //check if the number has already existed
        $data = Customer::where('phone',$customer_phone)->first();

        if(sizeof($data) == 1){
             return response()->json([
                'status' => 'error',
                'message' => 'Customer has already existed'
            ], 200);
        }
        //Start To New Customer
        $data_customer = array(
                            'name' =>   $customer_name,
                            'phone' =>   $customer_phone,
                            'creator_id' =>   $user_id,
                            'created_at' => $now
                        );
                $customer_id=Customer::insertGetId($data_customer);

            //Session::flash('msg', 'Order Process has been Created!');
            return response()->json([
                'status' => 'success',
                'message' => 'Customer has been created', 
                'customer_id' => $customer_id
            ], 200);

    }

    function addToCartDB(Request $request){
        $user_id  = Auth::id();
        $now      = date('Y-m-d H:i:s');
        $customer_id        = $request->input('customer_id');
        $discount           = $request->input('discount');
        $delivery_time      = $request->input('delivery_time');
        $address            = $request->input('address');
        $delivery_id        = $request->input('delivery_id');
        $data_order = array(
                    'customer_id'   =>   $customer_id,
                    'address'       =>   $address,
                    'delivery_time'       =>   $delivery_time,
                    'discount'       =>   $discount,
                    'transporter_id'       =>   $delivery_id,
                    'creator_id'    =>   $user_id,
                    'created_at'    => $now
                );
        $order_id_data=Model::insertGetId($data_order);
        $carts =  array();

        if($request->session()->has('carts')){
         $carts = $request->session()->get('carts');
        }
        $request->session()->put('carts', $carts);
        foreach($carts as $row){
            OrderDetails::insert(['order_id' => $order_id_data, 'product_id' => $row['product_id'],'qty' => $row['qty'], 'unit_price' => $row['price']]);
        }

        $request->session()->pull('carts', 'default');

        Session::flash('msg', 'Order Process has been Created!');
        //return view($this->route.'.menu-cart', ['route'=>$this->route,'carts'=>$carts]);
    }

}
