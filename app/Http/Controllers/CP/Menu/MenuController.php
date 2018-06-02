<?php

namespace App\Http\Controllers\CP\Menu;

use Auth;
use Session;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\CamCyber\FileUploadController as FileUpload;
use App\Http\Controllers\CamCyber\FunctionController;

use App\Model\Menu\Menu as Model;
use App\Model\Menu\MenuCategory as MenuCategory;
use App\Model\Menu\MenuSize as Size;
use App\Model\Menu\MenuExtra as Extra;
use App\Model\Setup\Type as Type;
use App\Model\Setup\Category as Category;
use App\Model\Restaurant\Restaurant as Restaurant;


class MenuController extends Controller
{
    protected $route; 
    public function __construct(){
        $this->route = "cp.menu";
    }
    function validObj($id=0){
        $data = Model::find($id);
        if(empty($data)){
           echo "Invalide Object"; die;
        }
    }

    public function index(){
        $types = Type::get();
        $restaurants = Restaurant::get();

        $data = Model::select('*');
        $limit      =   intval(isset($_GET['limit'])?$_GET['limit']:10); 
        $key       =   isset($_GET['key'])?$_GET['key']:"";
        $restaurant       =   isset($_GET['restaurant'])?$_GET['restaurant']:0;
        //dd($restaurant);
        $category       =   isset($_GET['category'])?$_GET['category']:0;
        $type       =   isset($_GET['type'])?$_GET['type']:0;
        $from=isset($_GET['from'])?$_GET['from']:"";
        $till=isset($_GET['till'])?$_GET['till']:"";
        $appends=array('limit'=>$limit);
        if( $restaurant != "" ){
            $data = $data->where('restaurant_id', 'like', '%'.$restaurant.'%');
            $appends['restaurant'] = $restaurant;


        }
        if( $category != "" ){
            $data = $data->where('category_id', 'like', '%'.$category.'%');
            $appends['category'] = $category;
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
        
        return view($this->route.'.index', ['route'=>$this->route,'types'=>$types,'restaurants'=>$restaurants, 'data'=>$data, 'appends'=>$appends]);
    }
    public function getCategory(){
        $restaurant_id = isset($_GET['restaurant_id'])?$_GET['restaurant_id']:'';
        if(  is_numeric ($restaurant_id) ){
            if( $restaurant_id != 0 ){
                $data = Category::select('id', 'name')->whereHas('r_categories', function ($query){ 
                    $restaurant_id = isset($_GET['restaurant_id'])?$_GET['restaurant_id']:'';
                    $query->where('restaurant_id', '>=', $restaurant_id);
                    })->get();
                return view($this->route.'.category-data', ['data'=>$data]);
            }else{
                echo '<select id="category_id" name="category_id" class="form-control">
                        <option value="0" >Please Select Restaurant First</option>
                    </select>
                    ';
            }
        }else{
            echo "Not vaide data: ";
        }
       
    }
    public function create(){
        $types = Type::get();
        $restaurants = Restaurant::get();
        return view($this->route.'.create', ['route'=>$this->route,'types'=>$types,'restaurants'=>$restaurants]);
    }
    public function store(Request $request) {
        $user_id  = Auth::id();
        $now      = date('Y-m-d H:i:s');

        
        $data = array(
                    'restaurant_id' =>   $request->input('restaurant_id'),
                    'category_id' =>   $request->input('category_id'),
                    'type_id' =>   $request->input('type_id'),
                    'name' =>   $request->input('name'), 
                    'instruction' =>  $request->input('instruction'), 

                      //Must include for all store
                    'creator_id' =>  $user_id,
                    'updater_id' =>  $user_id,
                    'created_at' => $now, 
                    'updated_at' => $now
                );
        Session::flash('invalidData', $data );
       $v   =   Validator::make(
                        $data, 
                        [
                           'name' => 'required|min:1|max:50', 
                                      
                        ]);

        $v->validate();
        $image = FileUpload::uploadFile($request, 'image', 'uploads/menu');
        if($image != ""){
            $data['image'] = $image; 
        }
		$id=Model::insertGetId($data);
        Session::flash('msg', 'Data has been Created!');
		return redirect(route($this->route.'.edit', $id));
    }

    public function edit($id = 0){
        $types = Type::get();
        $this->validObj($id);
        $restaurants = Restaurant::get();
        $data = Model::find($id);
        $restaurant_id = $data->restaurant_id;
        $categories = Category::select('id', 'name')->whereHas('r_categories', function ($query){ 
                    $restaurant_id = isset($_GET['restaurant_id'])?$_GET['restaurant_id']:'';
                    $query->where('restaurant_id', '>=', $restaurant_id);
                    })->get();
        return view($this->route.'.edit', ['route'=>$this->route, 'id'=>$id, 'data'=>$data,'types'=>$types,'restaurants'=>$restaurants,'categories'=>$categories]);
    }

    public function update(Request $request){
        $id = $request->input('id');

        $user_id  = Auth::id();
        $now      = date('Y-m-d H:i:s');
        $data = array(
                    'restaurant_id' =>   $request->input('restaurant_id'),
                    'category_id' =>   $request->input('category_id'),
                    'type_id' =>   $request->input('type_id'),
                    'name' =>   $request->input('name'), 
                    'instruction' =>  $request->input('instruction'), 
                    //Must include for all update
                    'updater_id' =>  $user_id,
                    'updated_at' => $now
                );

        $v   =   Validator::make(
                        $data, 
                        [
                           'name' => 'required|min:1|max:50',
                           'image' => [
                                            'sometimes',
                                            'required',
                                            'mimes:jpeg,png',
                            ], 
                        ]);

       
        $v->validate();

		
        $image = FileUpload::uploadFile($request, 'image', 'uploads/menu');
        if($image != ""){
            $data['image'] = $image; 
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
            'msg' => 'User has been deleted'
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
    public function sizes($id=0){
        $this->validObj($id);
        $data = Model::find($id)->sizes()->get();
        return view($this->route.'.sizes', ['route'=>$this->route, 'id'=>$id, 'data'=>$data]);

    }
    public function createSize($id=0){
        $this->validObj($id);
        return view($this->route.'.createSize',['route'=>$this->route, 'id'=>$id]);

    }
    public function storeSize(Request $request) {
        $data = array(
                    
                    'menu_id' =>   $request->input('id'), 
                    'name' =>  $request->input('name'),
                    'price' =>  $request->input('price')
                );
        Session::flash('invalidData', $data );
        Validator::make(
                        $request->all(), 
                        [
                            'name' => [
                                            'required'
                                        ],
                            'price' => [
                                            'required'
                                        ],
                        ],
                        [
                        ])->validate();

        
        $menu_id = $request->input('id');

        $id=Size::insertGetId($data);
        Session::flash('msg', 'Data has been Created!');
        return redirect(route($this->route.'.edit-size', ['id'=>$menu_id,'size_id'=>$id]));
       
    }

     public function editSize($id = 0,$size_id = 0){
        $this->validObj($id);
        $data = Model::find($id)->sizes()->find($size_id);
        return view($this->route.'.editSize', ['route'=>$this->route, 'id'=>$id,'size_id'=>$size_id, 'data'=>$data]);
    }

    public function updateSize(Request $request){
        $id = $request->input('size_id');
        Validator::make(
                        $request->all(), 
                        [
                           
                            'name' => [
                                            'required'
                                        ],
                            'price' => [
                                            'required'
                                        ],
                        ])->validate();

        
        $data = array(
                    
                    'menu_id' =>   $request->input('id'), 
                    'name' =>  $request->input('name'), 
                    'price' =>  $request->input('price')
                );
        
        Size::where('id', $id)->update($data);
        Session::flash('msg', 'Data has been updated!' );
        return redirect()->back();
    }

    public function trashSize($id){
        //Model::where('id', $id)->update(['deleter_id' => Auth::id()]);
        Size::find($id)->delete();
        Session::flash('msg', 'Data has been delete!' );
        return response()->json([
            'status' => 'success',
            'msg' => 'Size has been deleted'
        ]);
    }

    public function categories($id = 0){
        $this->validObj($id);
        $categories = Category::get();
        $menus = Model::find($id)->m_categories()->select('category_id')->get();
        
        return view($this->route.'.categories', ['route'=>$this->route, 'id'=>$id, 'categories'=>$categories, 'menus'=>$menus]);
    }


    public function check(Request $request){
        $menu_id    = $_GET['menu_id'];
        $category_id     = $_GET['category_id'];
        $now        = date('Y-m-d H:i:s');
       
        
        $category = Category::find($category_id);
        $data = $category->m_categories()->where(['menu_id' => $menu_id])->first();
        if(sizeof($data) == 1){
            $category->m_categories()->where('id', $data->id)->delete();
            return response()->json([
                  'status' => 'success',
                  'msg' => 'Restaurant has been removed.'
            ]);
        }else{
            $data_type=array(
                'menu_id' => $menu_id,
                'category_id' => $category_id,
                
                'created_at' => $now, 
                'updated_at' => $now
                );
             $category->m_categories()->insert($data_type);
             return response()->json([
                  'status' => 'success',
                  'msg' => 'Category has been added.'
              ]);
        }
    }
   
    public function extras($id=0){
        $this->validObj($id);
        $data = Model::find($id)->mExtras()->get();
        return view($this->route.'.extras', ['route'=>$this->route, 'id'=>$id, 'data'=>$data]);

    }
    public function createExtra($id=0){
        $this->validObj($id);
        return view($this->route.'.createExtra',['route'=>$this->route, 'id'=>$id]);

    }
    public function storeExtra(Request $request) {
        $data = array(
                    
                    'menu_id' =>   $request->input('id'), 
                    'name' =>  $request->input('name'),
                    'price' =>  $request->input('price')
                );
        Session::flash('invalidData', $data );
        Validator::make(
                        $request->all(), 
                        [
                            'name' => [
                                            'required'
                                        ],
                            'price' => [
                                            'required'
                                        ],
                        ],
                        [
                        ])->validate();

        
        $menu_id = $request->input('id');

        $id=Extra::insertGetId($data);
        Session::flash('msg', 'Data has been Created!');
        return redirect(route($this->route.'.edit-extra', ['id'=>$menu_id,'extra_id'=>$id]));
       
    }

     public function editExtra($id = 0,$extra_id = 0){
        $this->validObj($id);
        $data = Model::find($id)->mExtras()->find($extra_id);
        return view($this->route.'.editExtra', ['route'=>$this->route, 'id'=>$id,'extra_id'=>$extra_id, 'data'=>$data]);
    }

    public function updateExtra(Request $request){
        $id = $request->input('extra_id');
        Validator::make(
                        $request->all(), 
                        [
                           
                            'name' => [
                                            'required'
                                        ],
                            'price' => [
                                            'required'
                                        ],
                        ])->validate();

        
        $data = array(
                    
                    'menu_id' =>   $request->input('id'), 
                    'name' =>  $request->input('name'), 
                    'price' =>  $request->input('price')
                );
        
        Extra::where('id', $id)->update($data);
        Session::flash('msg', 'Data has been updated!' );
        return redirect()->back();
    }

    public function trashExtra($id){
        //Model::where('id', $id)->update(['deleter_id' => Auth::id()]);
        Extra::find($id)->delete();
        Session::flash('msg', 'Data has been delete!' );
        return response()->json([
            'status' => 'success',
            'msg' => 'Extra has been deleted'
        ]);
    }
}
