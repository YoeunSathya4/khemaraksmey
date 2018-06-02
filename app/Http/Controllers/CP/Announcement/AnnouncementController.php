<?php

namespace App\Http\Controllers\CP\Announcement;

use Auth;
use Session;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\CamCyber\FileUploadController as FileUpload;
use App\Http\Controllers\CamCyber\FunctionController;
use App\Http\Controllers\CamCyber\GenerateSlugController as GenerateSlug;

use App\Model\Announcement\Announcement as Model;
use Image;


class AnnouncementController extends Controller
{
    protected $route; 
    public function __construct(){
        $this->route = "cp.announcement";
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
        $from=isset($_GET['from'])?$_GET['from']:"";
        $till=isset($_GET['till'])?$_GET['till']:"";
        $appends=array('limit'=>$limit);
        if( $key != "" ){
            $data = $data->where('en_title', 'like', '%'.$key.'%')->orWhere('kh_title', 'like', '%'.$key.'%');
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
        $data= $data->orderBy('id', 'DESC')->paginate($limit);
        
        return view($this->route.'.index', ['route'=>$this->route, 'data'=>$data,'appends'=>$appends]);
    }
   
    public function create(){
        return view($this->route.'.create' , ['route'=>$this->route]);
    }
    public function store(Request $request) {
        $user_id    = Auth::id();
        $now        = date('Y-m-d H:i:s');

        $data = array(
                    'kh_title' =>   $request->input('kh_title'), 
                    'en_title' =>  $request->input('en_title'),
                    'slug'      =>   GenerateSlug::generateSlug('promotions', $request->input('en_title')),
                    'kh_description' =>   $request->input('kh_description'), 
                    'en_description' =>  $request->input('en_description'),
                    'creator_id' => $user_id,
                    'created_at' => $now
                );
        
        Session::flash('invalidData', $data );
        Validator::make(
                        $data, 
                        [
                            
                           'kh_title' => 'required',
                           'en_title' => 'required',
                           'kh_description' => 'required',
                           'en_description' => 'required'
                        ]);

        if($request->input('status')=="")
        {
            $data['is_published']=0;
        }else{
            $data['is_published']=1;
        }
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time().'.'.$image->getClientOriginalExtension(); 
            Image::make($image->getRealPath())->resize(420, 420)->save(public_path('uploads/announcement/image/'.$imagename));
            $data['image']=$imagename;
        }

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
                    'kh_title' =>   $request->input('kh_title'), 
                    'en_title' =>  $request->input('en_title'),
                    'slug'      =>   GenerateSlug::generateSlug('promotions', $request->input('en_title')),
                    'kh_description' =>   $request->input('kh_description'), 
                    'en_description' =>  $request->input('en_description'),
                    'updater_id' => $user_id,
                    'updated_at' => $now
                );
        

        Validator::make(
        				$data, 
			        	[
                            
                           'kh_title' => 'required',
                           'en_title' => 'required',
                           'kh_description' => 'required',
                           'en_description' => 'required'
						]);
        if($request->input('status')=="")
        {
            $data['is_published']=0;
        }else{
            $data['is_published']=1;
        }
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time().'.'.$image->getClientOriginalExtension(); 
            Image::make($image->getRealPath())->resize(420, 420)->save(public_path('uploads/announcement/image/'.$imagename));
            $data['image']=$imagename;
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
            'msg' => 'Data has been deleted'
        ]);
    }
    function updateStatus(Request $request){
      $id   = $request->input('id');
      $data = array('is_published' => $request->input('active'));
      Model::where('id', $id)->update($data);
      return response()->json([
          'status' => 'success',
          'msg' => 'Published status has been updated.'
      ]);
    }

}
