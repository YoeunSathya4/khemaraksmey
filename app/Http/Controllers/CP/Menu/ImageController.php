<?php

namespace App\Http\Controllers\CP\Menu;

use Auth;
use Session;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\CamCyber\FileUploadController as FileUpload;
use App\Http\Controllers\Controller;

use App\Model\Menu\Menu as Model;


class ImageController extends Controller
{
    
	protected $route; 
    public function __construct(){
        $this->route = "cp.menu.image";
    }
    public function index($id = 0){
        $data = Model::find($id)->images;
        return view($this->route.'.index', ['route'=>$this->route, 'id'=>$id, 'data'=>$data]);
    }

    public function create($id = 0){
        return view($this->route.'.create', ['route'=>$this->route, 'id'=>$id]);
    }

    public function store(Request $request) {
        
        $user_id    = Auth::id();
        $now        = date('Y-m-d H:i:s');
        $menu_id = $request->input('menu_id');

        $data       = array(
                    'menu_id' =>  $menu_id,
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
                            'image' => [
                                            'required',
                                            'mimes:jpeg,png',
                                            //Rule::dimensions()->width(360)->height(270),
                            ]
                        ],
                        [
                           'image.dimensions' => 'Please provide valide dimensions for photo with 360x270.'
                        ])->validate();

        $image = FileUpload::uploadFile($request, 'image', 'uploads/menu/image');
        if($image != ""){
            $data['image'] = $image; 
        }
        $id=Model::find($menu_id)->images()->insertGetId($data);
       
        Session::flash('msg', 'A Image has been uploaded!');
        return redirect(route($this->route.'.edit', ['id'=>$menu_id, 'image_id'=>$id]));
    }

    function edit($id, $image_id){
        $data = Model::find($id)->images()->find($image_id);
        if( sizeof($data) == 1){
            return view($this->route.'.edit', ['route'=>$this->route, 'id'=>$id, 'data'=>$data]);
        }else{
            echo "ivalide photo";
        }
    }

    public function update(Request $request) {
        $user_id    = Auth::id();
        $now        = date('Y-m-d H:i:s');
        $menu_id = $request->input('menu_id');
        $image_id = $request->input('image_id');
        $data       = array(
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


        $image = FileUpload::uploadFile($request, 'photo', 'uploads/menu/image');
        if($image != ""){
            $data['image'] = $image; 
        }

        Model::find($menu_id)->images()->where('id', $image_id)->update($data);
        Session::flash('msg', 'Image has been Created!');
        return redirect(route($this->route.'.edit', ['id'=>$menu_id, 'image_id'=>$image_id]));
    }

    function trash($image_id){
        $id = $_GET['id'];
        $user_id    = Auth::id();
        Model::find($id)->images()->where('id', $image_id)->update(['deleter_id' => $user_id]);
        Model::find($id)->images()->where('id', $image_id)->delete();
        Session::flash('msg', 'Photo has been delete!' );
        return response()->json([
            'status' => 'success',
            'msg' => 'Image has been deleted'
        ]);
    }

}
