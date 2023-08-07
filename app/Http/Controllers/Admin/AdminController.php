<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{ 
    public function index(Request $request){
        if( $request->cookie("isAdmin") && $request->cookie("isLogin") && $request->cookie("isData") ){
            return response()->view("admin/HomeAdmin");
        }else{
            return redirect("/logout");
        }
    }

    public function createAdmin(Request $request, $name, $email, $password, $phone, $dob, $pob, $address, $type, $department, $key)
    {
        try {
            if ( $key == "kumpanha") {
                if( validator([$type => "numeric"]) ){
                    DB::table('doctors_tb')->insert([
                        "doctor_name"=>$name,
                        "doctor_phone"=>$phone,
                        "doctor_address"=>$address,
                        "doctor_email"=>$email,
                        "doctor_password"=>Hash::make( $password ),
                        "doctor_dob"=>$dob,
                        "doctor_pob"=>$pob,
                        "department_id"=>$department,
                        "doctor_role_id"=>$type,
                        "created_at"=>new DateTime(),
                        "updated_at"=>new DateTime()
                    ]);
                    return response()->json([
                        "message" => "Added",
                    ], 201);
                } else{
                    return response()->json([
                        "message" => "Added Failed",
                    ], 201);
                }
            } else {
                return response()->json([
                    "message" => "Added again",
                ], 404);
            }
        } catch (Exception $ex) {
            return response()->json([
                "message" => "Added Failed",
                "error" => $ex
            ], 403);
        }
    }
        
}
