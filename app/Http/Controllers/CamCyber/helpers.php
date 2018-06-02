<?php
	use Illuminate\Support\Facades\Auth;
	use Illuminate\Support\Facades\DB;
    use App\Model\User\User as Staff;
    use App\Model\Setup\Role as Role;
    use App\Model\Setup\Access as Access;
    use App\Model\Property\Property as Property;
	
    function checkPermision($route)
	{
        if(Auth::user()->position_id == 1){
    	   return True;
        }else{
            $permision = DB::table('permisions')->select('id')->where('route', $route)->first();
            if(count($permision) == 1){
                $permision_id = $permision->id;
                $user_id = Auth::id();
                $credentail = DB::table('users_permisions')->select('id')->where(['user_id'=>$user_id, 'permision_id'=>$permision_id])->first();
                if(count($credentail) == 1){
                    return True;
                }else{
                    return False;
                }
            }else{
                return False;
            }
        }
	}
    function checkRole($property_id, $access){   
        if(Auth::user()->position_id == 1){
            return True;
        }else{
            //Find access_id
            $access = Access::select('id')->where('name', $access)->first();
            if(count($access) == 1){
                $access_id = $access->id;
                //Finding role_id
                $staff_id = Auth::id();
                $dataRole = DB::table('properties_staffs_roles')->select('role_id', 'is_primary')->where([ 'property_id'=>$property_id ,'staff_id'=>$staff_id])->first();
                if(count($dataRole) == 1){
                    $is_primary = $dataRole->is_primary; 
                    if($is_primary != 1){
                        $role_id = $dataRole->role_id;
                        $roleAccess = Role::find($role_id)->roleAccesses()->select('access_id')->get();
                        foreach($roleAccess as $row){
                            if($row->access_id == $access_id){
                                return True;
                            }
                        }
                        return False;
                    }else{
                        return True;
                    }
                }else{
                    return False;
                }
            }else{
                return False;
            }
        }
    }

    function checkIfHasRole($property_id){   
        if(Auth::user()->position_id == 1){
            return True;
        }else{
            $staff_id = Auth::id();
            $dataRole = DB::table('properties_staffs_roles')->select('role_id', 'is_primary')->where([ 'property_id'=>$property_id ,'staff_id'=>$staff_id])->first();
            if(count($dataRole) == 1){
                return True;
            }else{
                return False;
            }
        }
    }

    function displayCurrency($number){
        if($number >0 && $number < 1){
            return $number;
        }
        return  number_format($number, 2);
    }

    function orderCode($id){
        
        if($id > 0 && $id < 10){
            return "O-0000".$id;
        }else if($id >= 10 && $id < 100){
            return "O-000".$id;
        }else if($id >= 100 && $id < 1000){
            return "O-00".$id;
        }else if($id >= 1000 && $id < 100000){
            return "O-0".$id;
        }else if($id >= 10000 && $id < 1000000){
            return "O-".$id;
        }
       
    }

    function restaurantCode($id){
        
        if($id > 0 && $id < 10){
            return "R-0000".$id;
        }else if($id >= 10 && $id < 100){
            return "R-000".$id;
        }else if($id >= 100 && $id < 1000){
            return "R-00".$id;
        }else if($id >= 1000 && $id < 100000){
            return "R-0".$id;
        }else if($id >= 10000 && $id < 1000000){
            return "R-".$id;
        }
       
    }

    function menuCode($id){
        
        if($id > 0 && $id < 10){
            return "M-0000".$id;
        }else if($id >= 10 && $id < 100){
            return "M-000".$id;
        }else if($id >= 100 && $id < 1000){
            return "M-00".$id;
        }else if($id >= 1000 && $id < 100000){
            return "M-0".$id;
        }else if($id >= 10000 && $id < 1000000){
            return "M-".$id;
        }
       
    }

?>