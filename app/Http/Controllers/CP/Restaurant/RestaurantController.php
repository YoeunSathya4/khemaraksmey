<?php

namespace App\Http\Controllers\CP\Restaurant;

use Auth;
use Session;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\CamCyber\FileUploadController as FileUpload;
use App\Http\Controllers\CamCyber\FunctionController;

use App\Model\Restaurant\Restaurant as Model;
use App\Model\Restaurant\RestaurantContact as RestaurantContact;
use App\Model\Restaurant\RestaurantCategory as RestaurantCategory;
use App\Model\Setup\Category as Category;

use App\Model\Setup\RestaurantType as RTypes;

use Image;

class RestaurantController extends Controller
{
    protected $route; 
    public function __construct(){
        $this->route = "cp.restaurant";
    }
    function validObj($id=0){
        $data = Model::find($id);
        if(empty($data)){
           echo "Invalide Object"; die;
        }
    }

    public function index(){
        $types = RTypes::get();
        $data = Model::select('*');
        $limit      =   intval(isset($_GET['limit'])?$_GET['limit']:10); 
        $key       =   isset($_GET['key'])?$_GET['key']:"";
        $type       =   isset($_GET['type'])?$_GET['type']:0;
        $from=isset($_GET['from'])?$_GET['from']:"";
        $till=isset($_GET['till'])?$_GET['till']:"";
        $appends=array('limit'=>$limit);
        if( $key != "" ){
            $data = $data->where('name', 'like', '%'.$key.'%');
            $appends['key'] = $key;
        }
        if( $type != "" ){
            $data = $data->where('type_id', 'like', '%'.$type.'%');
            $appends['type'] = $type;
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
        
        return view($this->route.'.index', ['route'=>$this->route, 'data'=>$data, 'appends'=>$appends,'types'=>$types]);
    }
   
    public function create(){
        $r_types = RTypes::get();
        return view($this->route.'.create', ['route'=>$this->route,'r_types'=>$r_types]);
    }
    public function store(Request $request) {
        $user_id  = Auth::id();
        $now      = date('Y-m-d H:i:s');
        $data = array(
                    'type_id' =>   $request->input('type_id'),
                    'name' =>   $request->input('name'),
                    'creator_id' =>   $user_id,
                    'updater_id' =>   $user_id,
                    'created_at' => $now, 
                    'updated_at' => $now
                );
        Session::flash('invalidData', $data );
        Validator::make(
                        $request->all(), 
                        [
                            
                            'name' => 'required|min:2|max:150'
                        ])->validate();
        if($request->input('active')=="")
        {
            $data['is_published']=0;
        }else{
            $data['is_published']=1;
        }
        // $image = FileUpload::uploadFile($request, 'image', 'uploads/restaurant');
        // if($image != ""){
        //     $data['logo'] = $image; 
        // }
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time().'.'.$image->getClientOriginalExtension(); 
            Image::make($image->getRealPath())->resize(300, 300)->save(public_path('uploads/restaurant/logo/'.$imagename));
            //Image::make($photo->getRealPath())->resize(416, 270)->save(public_path('uploads/property/photo/416x270/'.$photoname));
            $data['logo']=$imagename;
        }

        // $banner = FileUpload::uploadFile($request, 'banner', 'uploads/restaurant');
        // if($banner != ""){
        //     $data['banner'] = $banner; 
        // }

        if($request->hasFile('banner')) {
            $banner = $request->file('banner');
            $bannername = time().'.'.$banner->getClientOriginalExtension(); 
            Image::make($banner->getRealPath())->resize(1024, 420)->save(public_path('uploads/restaurant/banner/'.$bannername));
            //Image::make($photo->getRealPath())->resize(416, 270)->save(public_path('uploads/property/photo/416x270/'.$photoname));
            $data['banner']=$bannername;
        }
		$id=Model::insertGetId($data);
        $restaurant = Model::find($id);
        $data_contact =array('restaurant_id'=>$id);
        $restaurant->contact()->insert($data_contact);

        Session::flash('msg', 'Data has been Created!');
		return redirect(route($this->route.'.edit', $id));
    }

    public function edit($id = 0){
        $this->validObj($id);
        $data = Model::find($id);
        $r_types = RTypes::get();
        return view($this->route.'.edit', ['route'=>$this->route, 'id'=>$id, 'data'=>$data,'r_types'=>$r_types]);
    }

    public function update(Request $request){
        $id = $request->input('id');
        $user_id  = Auth::id();
        $now      = date('Y-m-d H:i:s');
        Validator::make(
        				$request->all(), 
			        	[
                            
                            'name' => 'required|min:2|max:150'
                            
                        ],
                        [
                            
                        ])->validate();

		
		$data = array(
                    'type_id' =>   $request->input('type_id'),
                    'name' =>   $request->input('name'),
                    'updater_id' =>   $request->input('user_id'),
                );
        if($request->input('active')=="")
        {
            $data['is_published']=0;
        }else{
            $data['is_published']=1;
        }
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time().'.'.$image->getClientOriginalExtension(); 
            Image::make($image->getRealPath())->resize(300, 300)->save(public_path('uploads/restaurant/logo/'.$imagename));
            //Image::make($photo->getRealPath())->resize(416, 270)->save(public_path('uploads/property/photo/416x270/'.$photoname));
            $data['logo']=$imagename;
        }
        if($request->hasFile('banner')) {
            $banner = $request->file('banner');
            $bannername = time().'.'.$banner->getClientOriginalExtension(); 
            Image::make($banner->getRealPath())->resize(1024, 420)->save(public_path('uploads/restaurant/banner/'.$bannername));
            //Image::make($photo->getRealPath())->resize(416, 270)->save(public_path('uploads/property/photo/416x270/'.$photoname));
            $data['banner']=$bannername;
        }
       
        Model::where('id', $id)->update($data);

        
        Session::flash('msg', 'Data has been updated!' );
        return redirect()->back();
	}

    public function trash($id){
        Model::where('id', $id)->update(['deleter_id' => Auth::id()]);
        Model::find($id)->delete();
        Session::flash('msg', 'Data has been delete!' );
        return response()->json([
            'status' => 'success',
            'msg' => 'Restaurant has been deleted'
        ]);
    }
    function updateStatus(Request $request){
      $id   = $request->input('id');
      $data = array('is_published' => $request->input('active'));
      Model::where('id', $id)->update($data);
      return response()->json([
          'status' => 'success',
          'msg' => 'Status has been updated.'
      ]);
    }
    public function categories($id = 0){
        $this->validObj($id);
        return view($this->route.'.categories', ['route'=>$this->route, 'id'=>$id]);
    }


    

    public function getCategories(Request $request){
        $id = $request->input('id');
        $data = Category::where(function ($query) {
                $key = $_GET['key'];
                $query->where('name', 'like', '%'.$key.'%');
            })->whereDoesntHave('r_categories', function ($query) {
                $id = $_GET['id'];
                $query->where('restaurant_id', '=', $id);
            })->limit(50)->orderBy('id', 'DESC')->get();
        //$data = Category::get();
        
        return view($this->route.'.data-category', ['route'=>$this->route,'data'=>$data]);
    }

    public function selected($id = 0){
        $this->validObj($id);
        $restaurant_categories =  Model::find($id)->r_categories()->select('id', 'category_id')->orderBy('id', 'DESC')->get();
        
        return view($this->route.'.categories-result', ['restaurant_categories'=>$restaurant_categories]);
    }

    public function remove(Request $request){
        $id = $request->input('id');
        $category_id = $request->input('category_id');
        Model::find($id)->r_categories()->where('category_id', $category_id)->delete();
        Session::flash('msg', __('Category has been removed.') );
    }
    public function add(Request $request){
        
        $id = $request->input('id');
        
        $category_id = $request->input('category_id');
        $user_id    = Auth::id();
        $now        = date('Y-m-d H:i:s');
        $data       = array(
                    'restaurant_id' =>  $id,
                    'category_id' =>  $category_id,
                    'created_at' => $now, 
                    'updated_at' => $now
                );
        Model::find($id)->r_categories()->insert($data);
        Session::flash('msg', __('Category has been added.') );
    }

    public function storeCategory(Request $request) {
        $user_id  = Auth::id();
        $now      = date('Y-m-d H:i:s');
        $data = array(
                    'name' =>   $request->input('value'),
                    'creator_id' =>   $user_id,
                    'updater_id' =>   $user_id,
                    'created_at' => $now, 
                    'updated_at' => $now
                );
        Session::flash('invalidData', $data );
        Validator::make(
                        $request->all(), 
                        [
                            
                           'value' => 'required',
                        ])->validate();

        
        $id=Category::insertGetId($data);
        return response()->json([
          'status' => 'success',
          'msg' => 'Data has been updated'
        ]);
    }

    public function contact($id = 0){
        $this->validObj($id);
        $data = Model::find($id)->contact;
        //dd($data);
        return view($this->route.'.contact', ['route'=>$this->route, 'id'=>$id, 'data'=>$data]);
    }

    public function updateContact(Request $request){
        $id = $request->input('id');
        $user_id  = Auth::id();
        $now      = date('Y-m-d H:i:s');
        $restaurant_id  = $request->input('restaurant_id');
        //dd($restaurant_id);
        Validator::make(
                        $request->all(), 
                        [
                           
                            
                        ],
                        [
                            
                        ])->validate();

        
        $data = array(
                    'restaurant_id' =>   $restaurant_id,
                    'phone_1' =>   $request->input('phone_1'),
                    'phone_2' =>   $request->input('phone_2'),
                    'address' =>   $request->input('address'),
                    'opened' =>   $request->input('opened'),
                    'closed' =>   $request->input('closed'),
                    'lat' =>   $request->input('lat'),
                    'lon' =>   $request->input('lon'),
                    'updater_id' =>   $request->input('user_id'),
                );
        
       
        RestaurantContact::where('id', $id)->update($data);
        Session::flash('msg', 'Data has been updated!' );
        return redirect()->back();
    }
}
