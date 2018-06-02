<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Model\Property\Property as Model;
use App\Model\User\User as User;
use App\Model\Setup\Action as Action;
use App\Model\Setup\Type as Type;
use App\Model\Setup\Owner as Owner;
use App\Model\Setup\Province as Province;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function checkPermision($route){
    	
       if( ! checkPermision($route)){
            echo "In valide access!"; die;
       }
    }

    public function getPropertyIdByListingCode($listing_code =""){
        if( $listing_code != "" ){
            $length = strlen($listing_code); 
            if($length == 8 || $length == 9 || $length == 10 ){
                $is_published = 0;
                $province_id = 0;
                $type_id = 0;

                $l = '';
                $provinceAbbre = '';
                $typeAbbre = '';
                $code = '';

                if( $length == 8 ){
                    $is_published   = 1;
                    $l              = '';
                    $provinceAbbre  = $listing_code[0].$listing_code[1];
                    $typeAbbre      = $listing_code[3];
                    $code           = $listing_code[4].$listing_code[5].$listing_code[6].$listing_code[7];
                }else if( $length == 9 || $length ==10 ){
                    $l              = $listing_code[0];
                    if($l == "L"){
                        $is_published   = 0;
                        $provinceAbbre  = $listing_code[1].$listing_code[2];
                        if(is_numeric ($listing_code[5])){
                            $typeAbbre      = $listing_code[4];
                            $code           = $listing_code[5].$listing_code[6].$listing_code[7].$listing_code[8];
                        }else{
                            $typeAbbre      = $listing_code[4].$listing_code[5];
                            $code           = $listing_code[6].$listing_code[7].$listing_code[8].$listing_code[9];
                        }
                    }else{
                        $is_published   = 1;
                        $provinceAbbre  = $listing_code[0].$listing_code[1];
                        if(is_numeric ($listing_code[4])){
                            $typeAbbre      = $listing_code[3];
                            $code           = $listing_code[4].$listing_code[5].$listing_code[6].$listing_code[7];
                        }else{
                            $typeAbbre      = $listing_code[3].$listing_code[4];
                            $code           = $listing_code[5].$listing_code[6].$listing_code[7].$listing_code[8];
                        }
                    }
                    
                }

                $province_id = Province::select('id')->where('abbre', $provinceAbbre)->first()->id;
                $type_id = Type::select('id')->where('abbre', $typeAbbre)->first()->id;
               
                $data = Model::where(['province_id'=>$province_id, 'type_id'=>$type_id, 'listing_code'=>$code, 'is_published'=>$is_published])->first();
                if(sizeof($data) == 1){
                    return $data->id;
                }else{
                    return 0;
                }
            }
        }
    }


}
