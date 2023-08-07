<?php
    namespace App\Http\Components;

use Exception;
use Illuminate\Support\Facades\DB;

    class AdminComponent{
        
        public function isAdmin($email){


            try{
                $auth = DB::select("select * from doctors_tb dt inner join doctor_roles_tb drt on dt.doctor_role_id = drt.doctor_role_id where drt.doctor_role_name = ? and dt.doctor_email = ?", ["admin", $email]);
                if( $auth ){
                    return true;
                }else{
                    return false;
                }
            }
            catch(Exception $ex){
                return false;
            }

        }

        public function checkEmailAlreadyUsed( $type , $email ){

            if($type == "doctor"){
                $auth = DB::table("doctors_tb")->where("doctor_email", $email)->get();
                if( count($auth) > 0 ){
                    return true;
                }else{
                    return false;
                }
            }
            else if( $type == "receptionist" ){
                $auth = DB::table("receptionist_tb")->where("receptionist_email", $email)->get();
                if( count($auth) > 0 ){
                    return true;
                }else{
                    return false;
                }
            }
            else{
                return false;
            }

        }

    }


?>