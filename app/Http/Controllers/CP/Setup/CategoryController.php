<?php

namespace App\Http\Controllers\CP\Setup;

use Auth;
use Session;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Model\Setup\Category as Model;

class CategoryController extends Controller
{
    protected $route; 
    public function __construct(){
        $this->route = "cp.setup.category";
    }
    function validObj($id=0){
        $data = Model::find($id);
        if(empty($data)){
           echo "Invalide Object"; die;
        }
    }

    public function index(){
        $data = Model::orderBy('id', 'DESC')->get();
        return view($this->route.'.index', ['route'=>$this->route, 'data'=>$data]);
    }
   
    public function create(){
        return view($this->route.'.create', ['route'=>$this->route]);
    }
    public function store(Request $request) {
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

        
		$id=Model::insertGetId($data);
        return response()->json([
          'status' => 'success',
          'msg' => 'Data has been updated'
        ]);
    }

   
    public function update(Request $request){
        $id = $request->input('id');
        $user_id  = Auth::id();
        $now      = date('Y-m-d H:i:s');
        Validator::make(
        				$request->all(), 
			        	[
                            
                            'value' => 'required',
                            
                        ],
                        [
                            
                        ])->validate();

		
		$data = array(
                    'name' =>   $request->input('value'),
                    'updater_id' =>   $request->input('user_id'),
                );

       
        Model::where('id', $id)->update($data);
        return response()->json([
          'status' => 'success',
          'msg' => 'Data has been updated'
        ]);
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
      $data = array('is_fa_icon_used' => $request->input('active'));
      Model::where('id', $id)->update($data);
      return response()->json([
          'status' => 'success',
          'msg' => 'Feature status has been updated.'
      ]);
    }
   
   
}
