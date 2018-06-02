<?php

namespace App\Http\Controllers\CP\Setup;

use Auth;
use Session;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\CamCyber\FileUploadController as FileUpload;
use App\Http\Controllers\CamCyber\FunctionController;

use App\Model\Setup\Location as Model;

class LocationController extends Controller
{
    protected $route; 
    public function __construct(){
        $this->route = "cp.setup.location";
    }
    function validObj($id=0){
        $data = Model::find($id);
        if(empty($data)){
           echo "Invalide Object"; die;
        }
    }

    public function index(){
        $data = Model::select('*')->get();
        
        return view($this->route.'.index', ['route'=>$this->route, 'data'=>$data]);
    }
   
    public function create(){
        return view($this->route.'.create' , ['route'=>$this->route]);
    }
    public function store(Request $request) {
        $user_id    = Auth::id();
        $now        = date('Y-m-d H:i:s');

        $data = array(
                    'name' =>   $request->input('name'), 
                    'price' =>  $request->input('price'),
                    'estimate_time' =>  $request->input('estimate_time'),
                    'creator_id' => $user_id,
                    'created_at' => $now
                );
        
        Session::flash('invalidData', $data );
        Validator::make(
                        $request->all(), 
                        [
                            'name' => 'required',
                            
                        ], 

                        [
                           
                            'image.dimensions' => 'Please provide valide image dimensions 158x42.',
                        ])->validate();
        // if($request->input('status')=="")
        // {
        //     $data['is_published']=0;
        // }else{
        //     $data['is_published']=1;
        // }
        
		$id=Model::insertGetId($data);
        Session::flash('msg', 'Data has been Created!');
		return redirect(route($this->route.'.edit', $id));
    }

    public function edit($id = 0){
        $this->validObj($id);
        $data = Model::find($id);
        return view($this->route.'.edit', ['route'=>$this->route, 'id'=>$id, 'data'=>$data]);
    }

    public function update(Request $request){
        $id = $request->input('id');
        $user_id    = Auth::id();
        $now        = date('Y-m-d H:i:s');

        $data = array(
                    'name' =>   $request->input('name'), 
                    'price' =>  $request->input('price'),
                    'estimate_time' =>  $request->input('estimate_time'),
                    'updater_id' => $user_id,
                    'updated_at' => $now
                );
        
        Validator::make(
                        $request->all(), 
                        [
                            'name' => 'required',
                           
                        ], 

                        [
                           
                            'image.dimensions' => 'Please provide valide image dimensions 158x42.',
                        ])->validate();
        // if($request->input('status')=="")
        // {
        //     $data['is_published']=0;
        // }else{
        //     $data['is_published']=1;
        // }
       
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
            'msg' => 'Award has been deleted'
        ]);
    }
    function status(Request $request){
      $id   = $request->input('id');
      $data = array('is_published' => $request->input('status'));
      Model::where('id', $id)->update($data);
      return response()->json([
          'status' => 'success',
          'msg' => 'Sponsor status has been updated.'
      ]);
    }

}
