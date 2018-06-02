<?php

namespace App\Http\Controllers\CP\Category;

use Auth;
use Session;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\CamCyber\FileUploadController as FileUpload;
use App\Http\Controllers\Controller;

use App\Model\Category\Category as Model;
use App\Model\Category\SubCategory as SubCategory;
use App\Model\Category\SubSubCategory as SubSubCategory;
use Image;

class SubCategoryController extends Controller
{
    
	protected $route; 
    public function __construct(){
        $this->route = "cp.category.sub-category";
    }
    public function index($id = 0){
        $data = Model::find($id)->subCategories();
        
        $key=isset($_GET['key'])?$_GET['key']:0;
        $limit=intval(isset($_GET['limit'])?$_GET['limit']:10);

        $appends=array('limit'=>$limit);
       
        if($key!=""){
            $data = $data->where(function($query) use ($key){
                $query->where('en_name', 'Like', '%'.$key.'%');
            });
            $appends['key'] = $key;
        }
        $data= $data->orderBy('created_at', 'DESC')->paginate($limit);
        return view($this->route.'.index', ['route'=>$this->route, 'id'=>$id, 'data'=>$data,'appends'=>$appends]);
    }

    public function create($id = 0){
        return view($this->route.'.create', ['route'=>$this->route, 'id'=>$id]);
    }

    public function store(Request $request) {
        $category_id = $request->input('category_id');
        $user_id    = Auth::id();
        $now        = date('Y-m-d H:i:s');
        $data       = array(
                    'category_id' =>  $category_id,
                    
                    'en_name' =>   $request->input('en_name'), 
                    'kh_name' =>   $request->input('kh_name'), 
                    'creator_id' =>  $user_id,
                    'updater_id' =>  $user_id,
                    'created_at' =>  $now, 
                    'updated_at' =>  $now
                );
        //print_r($data); die;
        Session::flash('invalidData', $data );
        Validator::make(
                        $request->all(), 
                        [
                            'en_name' => 'required',
                            'kh_name' => 'required',
                            'image' => [
                                            'required',
                                            'mimes:jpeg,png',
                            ]
                        ],
                        [])->validate();
        

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time().'.'.$image->getClientOriginalExtension(); 
            Image::make($image->getRealPath())->resize(400, 313)->save(public_path('uploads/subcategory/image/'.$imagename));
            $data['image']=$imagename;
        }
        $id=SubCategory::insertGetId($data);
       
        Session::flash('msg', 'A Sub Category has been uploaded!');
        return redirect(route($this->route.'.edit', ['id'=>$category_id, 'subcategory_id'=>$id]));
    }

    function edit($id, $subcategory_id){
        $data = Model::find($id)->subCategories()->find($subcategory_id);
        if( sizeof($data) == 1){
            return view($this->route.'.edit', ['route'=>$this->route, 'id'=>$id,'subcategory_id'=>$subcategory_id, 'data'=>$data]);
        }else{
            echo "ivalide data";
        }
    }

    public function update(Request $request) {
        $user_id    = Auth::id();
        $now        = date('Y-m-d H:i:s');
        $category_id = $request->input('category_id');
        $subcategory_id = $request->input('subcategory_id');
        $data       = array(
                    'category_id' =>  $category_id,
                    'en_name' =>   $request->input('en_name'), 
                    'kh_name' =>   $request->input('kh_name'), 
                    'updater_id' =>  $user_id,
                );
        //print_r($data); die;
        Session::flash('invalidData', $data );
        Validator::make(
                        $request->all(), 
                        [
                            'en_name' => 'required',
                            'kh_name' => 'required',
                            'image' => [
                                            'sometimes',
                                            'required',
                                            'mimes:jpeg,png',
                            ]
                        ],
                        [
                        ])->validate();

        
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time().'.'.$image->getClientOriginalExtension(); 
            Image::make($image->getRealPath())->resize(400, 313)->save(public_path('uploads/subcategory/image/'.$imagename));
            $data['image']=$imagename;
        }

        Model::find($category_id)->subCategories()->where('id', $subcategory_id)->update($data);
        Session::flash('msg', 'Sub Category has been Created!');
        return redirect(route($this->route.'.edit', ['id'=>$category_id, 'subcategory_id'=>$subcategory_id]));
    }
    
    function trash($subcategory_id){
        $id = $_GET['id'];
        $user_id    = Auth::id();
        Model::find($id)->subCategories()->where('id', $subcategory_id)->update(['deleter_id' => $user_id]);
        Model::find($id)->subCategories()->where('id', $subcategory_id)->delete();
        Session::flash('msg', 'Menu has been delete!' );
        return response()->json([
            'status' => 'success',
            'msg' => 'Menu has been deleted'
        ]);
    }

    public function mainCategories($category_id=0, $subcategory_id=0){
        //$this->validObj($menu_id);
        $data = SubCategory::find($subcategory_id)->subSubCategories()->get();
        return view($this->route.'.mainCategory', ['route'=>$this->route,'id'=>$category_id, 'subcategory_id'=>$subcategory_id, 'data'=>$data]);

    }
    public function createMainCategory($category_id=0,$subcategory_id=0){
        //$this->validObj($restaurant_id);
        return view($this->route.'.createMainCategory',['route'=>$this->route, 'id'=>$category_id,'subcategory_id'=>$subcategory_id]);

    }
    public function storeMainCategory(Request $request) {
        $data = array(
                    
                    'sub_category_id' =>   $request->input('subcategory_id'), 
                    'en_name' =>  $request->input('en_name'),
                    'kh_name' =>  $request->input('kh_name')
                );
        Session::flash('invalidData', $data );
        Validator::make(
                        $request->all(), 
                        [
                            'en_name' => [
                                            'required'
                                        ],
                            'kh_name' => [
                                            'required'
                                        ],
                        ],
                        [
                        ])->validate();

        $category_id = $request->input('category_id');

        $subcategory_id = $request->input('subcategory_id');

        $id=SubSubCategory::insertGetId($data);
        Session::flash('msg', 'Data has been Created!');
        return redirect(route('cp.category.sub-category.edit-mainCategory', ['category_id'=>$category_id,'subcategory_id'=>$subcategory_id,'maincategory_id'=>$id]));
       
    }

     public function editMainCategory($category_id = 0,$subcategory_id = 0, $maincategory_id=0){
        //$this->validObj($id);
        $data = SubCategory::find($subcategory_id)->subSubCategories()->find($maincategory_id);
        return view($this->route.'.editMainCategory', ['route'=>$this->route, 'id'=>$category_id,'subcategory_id'=>$subcategory_id ,'maincategory_id'=>$maincategory_id, 'data'=>$data]);
    }

    public function updateMainCategory(Request $request){
        $id = $request->input('main_id');

        Validator::make(
                        $request->all(), 
                        [
                           
                            'en_name' => [
                                            'required'
                                        ],
                            'kh_name' => [
                                            'required'
                                        ],
                        ])->validate();

        
        $data = array(
                    
                    'sub_category_id' =>   $request->input('sub_category_id'), 
                    'en_name' =>  $request->input('en_name'),
                    'kh_name' =>  $request->input('kh_name')
                );
        
        SubSubCategory::where('id', $id)->update($data);
        Session::flash('msg', 'Data has been updated!' );
        return redirect()->back();
    }

    public function trashMainCategory($id){
        //Model::where('id', $id)->update(['deleter_id' => Auth::id()]);
        SubSubCategory::find($id)->delete();
        Session::flash('msg', 'Data has been delete!' );
        return response()->json([
            'status' => 'success',
            'msg' => 'Main Category has been deleted'
        ]);
    }

}
