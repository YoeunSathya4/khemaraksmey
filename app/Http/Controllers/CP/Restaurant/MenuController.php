<?php

namespace App\Http\Controllers\CP\Restaurant;

use Auth;
use Session;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\CamCyber\FileUploadController as FileUpload;
use App\Http\Controllers\Controller;

use App\Model\Restaurant\Restaurant as Model;
use App\Model\Setup\Type as Type;
use App\Model\Setup\Category as Category;
use App\Model\Menu\MenuSize as Size;
use App\Model\Menu\MenuExtra as Extra;
use App\Model\Menu\Menu as Menu;

use Image;

class MenuController extends Controller
{
    
	protected $route; 
    public function __construct(){
        $this->route = "cp.restaurant.menu";
    }
    public function index($id = 0){
        $data = Model::find($id)->menus();
        $category_id=intval(isset($_GET['category_id'])?$_GET['category_id']:0); 
        $key=isset($_GET['key'])?$_GET['key']:0;
        $limit=intval(isset($_GET['limit'])?$_GET['limit']:10);

        $appends=array('limit'=>$limit);
        if($category_id!=0){
            $data = $data->where('category_id', $category_id);
            $appends['category_id'] = $category_id;
        }
        if($key!=""){
            $data = $data->where(function($query) use ($key){
                $query->where('name', 'Like', '%'.$key.'%');
            });
            $appends['key'] = $key;
        }
       
        $data= $data->orderBy('created_at', 'DESC')->paginate($limit);

        $categories =  Model::find($id)->r_categories()->select('id', 'category_id')->orderBy('id', 'DESC')->get();
        //dd($categories); die;
        return view($this->route.'.index', ['route'=>$this->route, 'id'=>$id, 'data'=>$data, 'categories'=>$categories, 'appends'=>$appends]);
    }

    public function create($id = 0){
        $types = Type::get();
        $restaurant_categories =  Model::find($id)->r_categories()->select('id', 'category_id')->orderBy('id', 'DESC')->get();

        return view($this->route.'.create', ['route'=>$this->route, 'id'=>$id,'types'=>$types,'restaurant_categories'=>$restaurant_categories]);
    }

    public function store(Request $request) {
        
        $user_id    = Auth::id();
        $now        = date('Y-m-d H:i:s');
        $restaurant_id = $request->input('restaurant_id');

        $data       = array(
                    'restaurant_id' =>  $restaurant_id,
                    'type_id' =>   $request->input('type_id'),
                    'category_id' =>   $request->input('category_id'),
                    'name' =>   $request->input('name'), 
                    'instruction' =>  $request->input('instruction'),
                    'creator_id' =>  $user_id,
                    'updater_id' =>  $user_id,
                    'deleter_id' =>  1,
                    'created_at' =>  $now, 
                    'updated_at' =>  $now
                );
        //print_r($data); die;
        Session::flash('invalidData', $data );
        Validator::make(
                        $request->all(), 
                        [
                            'name' => [
                                            'required'
                            ]
                        ],
                        [
                           'image.dimensions' => 'Please provide valide dimensions for photo with 360x270.'
                        ])->validate();
        if($request->input('active')=="")
        {
            $data['is_published']=0;
        }else{
            $data['is_published']=1;
        }
        // $image = FileUpload::uploadFile($request, 'image', 'uploads/restaurant/menu');
        // if($image != ""){
        //     $data['image'] = $image; 
        // }

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time().'.'.$image->getClientOriginalExtension(); 
            Image::make($image->getRealPath())->resize(400, 313)->save(public_path('uploads/restaurant/menu/'.$imagename));
            //Image::make($photo->getRealPath())->resize(416, 270)->save(public_path('uploads/property/photo/416x270/'.$photoname));
            $data['image']=$imagename;
        }
        $id=Menu::insertGetId($data);
       
        Session::flash('msg', 'A Menu has been uploaded!');
        return redirect(route($this->route.'.edit', ['id'=>$restaurant_id, 'menu_id'=>$id]));
    }

    function edit($id, $menu_id){
        $types = Type::get();
        $restaurant_categories =  Model::find($id)->r_categories()->select('id', 'category_id')->orderBy('id', 'DESC')->get();
        $data = Model::find($id)->menus()->find($menu_id);
        if( sizeof($data) == 1){
            return view($this->route.'.edit', ['route'=>$this->route, 'id'=>$id,'menu_id'=>$menu_id, 'data'=>$data,'types'=>$types,'restaurant_categories'=>$restaurant_categories]);
        }else{
            echo "ivalide data";
        }
    }

    public function update(Request $request) {
        $user_id    = Auth::id();
        $now        = date('Y-m-d H:i:s');
        $restaurant_id = $request->input('restaurant_id');
        $menu_id = $request->input('menu_id');
        $data       = array(
                    'restaurant_id' =>  $restaurant_id,
                    'type_id' =>   $request->input('type_id'),
                    'category_id' =>   $request->input('category_id'),
                    'name' =>   $request->input('name'), 
                    'instruction' =>  $request->input('instruction'),
                    'is_published' =>   $request->input('is_published'),
                    'updater_id' =>  $user_id,
                );
        //print_r($data); die;
        Session::flash('invalidData', $data );
        Validator::make(
                        $request->all(), 
                        [
                            'image' => [
                                            'sometimes',
                                            'required',
                                            'mimes:jpeg,png',
                                            //Rule::dimensions()->width(416)->height(270),
                            ]
                        ],
                        [
                           'image.dimensions' => 'Please provide valide dimensions for photo with 416x270.'
                        ])->validate();

        if($request->input('active')=="")
        {
            $data['is_published']=0;
        }else{
            $data['is_published']=1;
        }
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time().'.'.$image->getClientOriginalExtension(); 
            Image::make($image->getRealPath())->resize(400, 313)->save(public_path('uploads/restaurant/menu/'.$imagename));
            //Image::make($photo->getRealPath())->resize(416, 270)->save(public_path('uploads/property/photo/416x270/'.$photoname));
            $data['image']=$imagename;
        }

        Model::find($restaurant_id)->menus()->where('id', $menu_id)->update($data);
        Session::flash('msg', 'Image has been Created!');
        return redirect(route($this->route.'.edit', ['id'=>$restaurant_id, 'menu_id'=>$menu_id]));
    }
    function updateStatus(Request $request){
      $id   = $request->input('id');
      $data = array('is_published' => $request->input('active'));
      Menu::where('id', $id)->update($data);
      return response()->json([
          'status' => 'success',
          'msg' => 'Status has been updated.'
      ]);
    }
    function trash($menu_id){
        $id = $_GET['id'];
        $user_id    = Auth::id();
        Model::find($id)->menus()->where('id', $menu_id)->update(['deleter_id' => $user_id]);
        Model::find($id)->menus()->where('id', $menu_id)->delete();
        Session::flash('msg', 'Menu has been delete!' );
        return response()->json([
            'status' => 'success',
            'msg' => 'Menu has been deleted'
        ]);
    }

    public function sizes($restaurant_id=0, $menu_id=0){
        //$this->validObj($menu_id);
        $data = Menu::find($menu_id)->sizes()->get();
        return view($this->route.'.sizes', ['route'=>$this->route,'id'=>$restaurant_id, 'menu_id'=>$menu_id, 'data'=>$data]);

    }
    public function createSize($restaurant_id=0,$menu_id=0){
        //$this->validObj($restaurant_id);
        return view($this->route.'.createSize',['route'=>$this->route, 'id'=>$restaurant_id,'menu_id'=>$menu_id]);

    }
    public function storeSize(Request $request) {
        $data = array(
                    
                    'menu_id' =>   $request->input('menu_id'), 
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

        $restaurant_id = $request->input('restaurant_id');

        $menu_id = $request->input('menu_id');

        $id=Size::insertGetId($data);
        Session::flash('msg', 'Data has been Created!');
        return redirect(route('cp.restaurant.menu.edit-size', ['restaurant_id'=>$restaurant_id,'menu_id'=>$menu_id,'size_id'=>$id]));
       
    }

     public function editSize($restaurant_id = 0,$menu_id = 0, $size_id=0){
        //$this->validObj($id);
        $data = Menu::find($menu_id)->sizes()->find($size_id);
        return view($this->route.'.editSize', ['route'=>$this->route, 'id'=>$restaurant_id,'menu_id'=>$menu_id ,'size_id'=>$size_id, 'data'=>$data]);
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
                    
                    'menu_id' =>   $request->input('menu_id'), 
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


    public function extras($restaurant_id=0, $menu_id=0){
        //$this->validObj($menu_id);
        $data = Menu::find($menu_id)->extras()->get();
        return view($this->route.'.extras', ['route'=>$this->route,'id'=>$restaurant_id, 'menu_id'=>$menu_id, 'data'=>$data]);

    }
    public function createExtra($restaurant_id=0,$menu_id=0){
        //$this->validObj($restaurant_id);
        return view($this->route.'.createExtra',['route'=>$this->route, 'id'=>$restaurant_id,'menu_id'=>$menu_id]);

    }
    public function storeExtra(Request $request) {
        $data = array(
                    
                    'menu_id' =>   $request->input('menu_id'), 
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

        $restaurant_id = $request->input('restaurant_id');

        $menu_id = $request->input('menu_id');

        $id=Extra::insertGetId($data);
        Session::flash('msg', 'Data has been Created!');
        return redirect(route('cp.restaurant.menu.edit-extra', ['restaurant_id'=>$restaurant_id,'menu_id'=>$menu_id,'extra_id'=>$id]));
       
    }

     public function editExtra($restaurant_id = 0,$menu_id = 0, $extra_id=0){
        //$this->validObj($id);
        $data = Menu::find($menu_id)->extras()->find($extra_id);
        return view($this->route.'.editExtra', ['route'=>$this->route, 'id'=>$restaurant_id,'menu_id'=>$menu_id ,'extra_id'=>$extra_id, 'data'=>$data]);
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
                    
                    'menu_id' =>   $request->input('menu_id'), 
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
