<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index(Request $request){
        if( $request->cookie('isLogin') ){
            if( $request->cookie("isAdmin") ){
                return redirect("/admin/dashboard");
            }else{
                return redirect("/failed");
            }
        }else{
            return response()->view("LoginPage");
        }
    }

    public function LoginHandle(Request $request){

        $request->validate([
            "email"=>"required|email",
            "password"=>"required|min:8|max:20",
            "type"=>"required|min:1"
        ]);

        if( $request->input("type") == "admin" ){
             $data = DB::select("SELECT dt.* FROM doctors_tb dt
                                LEFT JOIN doctor_roles_tb dr
                                ON dr.doctor_role_id = dt.doctor_role_id
                                WHERE dr.doctor_role_name = 'admin' AND dt.doctor_email = ? " , [ $request->input("email") ]);

                // return response()->json($data);
            if( count($data) > 0 && Hash::check( $request->input("password"),$data[0]->doctor_password ) ){
                $ck1 = cookie("isAdmin", true , 60 * 24 );
                $ck2 = cookie("isData", $data[0]->doctor_email, 60 * 24 );
                $ck3 = cookie("isLogin", true, 60 * 24 );
                return redirect("/admin/dashboard")->withCookies([$ck1, $ck2, $ck3 ]);
            }else{
                return redirect("/login?message=Something wrong");
            }
        }else if( $request->input("type") == "doctor"){
            return redirect("/doctor");
        }
        else if( $request->input("type") == "receptionist"){
            return redirect("/receptionist");
        }

        // return >redirectTo("/login");

    }
}
