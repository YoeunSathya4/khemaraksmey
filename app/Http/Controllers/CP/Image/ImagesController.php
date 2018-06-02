<?php

namespace App\Http\Controllers\User\Image;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Session;
use Illuminate\Validation\Rule;
use App\Http\Controllers\CamCyber\FileUploadController as FileUpload;

use App\Model\Image\Image as Model;


class ImagesController extends Controller
{
    
    function __construct (){
       
    }

   
    public function listData($page = ""){   
      $data = Model::where('page', $page)->get();
      if(!empty($data)){
        return view('cp.image.list', ['page' => $page, 'data'=>$data]);
      }else{
        return response(view('errors.404'), 404);
      }
    }
    public function showEditForm($slug = ""){   
      $data = Model::where('slug', $slug)->first();
      if(!empty($data)){
        return view('user.image.editForm', ['data'=>$data]);
      }else{
        return response(view('errors.404'), 404);
      }
    }
    public function update(Request $request){   
      $id = $request->input('id');
      $slug = $request->input('slug');
      $image = "";
      $published = $request->input('published');
      
      $data = array(
                  'published' =>   $published,
              );

      $validate['image'] = array( 'sometimes',
                                  'required',
                                );
      
      Validator::make($request->all(), $validate)->validate();
  
      $image = FileUpload::uploadFile($request, 'image', 'uploads/image');
      if($image != ""){
          $data['image'] = $image; 
      }

      Model::where('id', $id)->update($data);
      Session::flash('msg', 'Data has been updated!' );
      return redirect()->back(); 
    }
    function updateStatus(Request $request){
      $id   = $request->input('id');
      $data = array('published' => $request->input('published'));
      Model::where('id', $id)->update($data);
      return response()->json([
          'status' => 'success',
          'msg' => 'Images status has been updated.'
      ]);
    }
   
}
