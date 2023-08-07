<?php

namespace App\Http\Controllers\Admin;

use App\Http\Components\AdminComponent;
use App\Http\Controllers\Controller;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    public function index(Request $request){
        if( $request->cookie("isAdmin") && $request->cookie("isLogin") && $request->cookie("isData") ){
            $count = DB::select("SELECT COUNT(*) FROM doctors_tb");
            $roles = DB::table("doctor_roles_tb")->get();
            $departments = DB::table("departments_tb")->get();
            return view("admin/DoctorAdmin")->with("count", strval( $count[0]->count ) )->with(["roles"=>$roles])->with(["departments"=>$departments]);
        }else{
            return redirect("/logout");
        }
    }

    public function GetDoctor(Request $request){

        try{
            $limit = $request->get("limit") ? $request->get("limit") : 10;
            $page = $request->get("page") ? $request->get("page") : 1;

            $datas = DB::select("SELECT dp.department_name, dr.doctor_role_name,dc.* FROM doctors_tb dc
            LEFT JOIN departments_tb dp ON dc.department_id = dp.department_id
            LEFT JOIN doctor_roles_tb dr ON dr.doctor_role_id = dc.doctor_role_id
            LIMIT ? OFFSET ?" , [ $limit, ( $page - 1 ) * $limit ] );
            return response()->json([
                "datas"=>$datas,
            ]);
        }
        catch(Exception $ex){
            return response()->json([
                "datas"=>[],
                "error"=>$ex
            ]);
        }

    }

    public function AddDoctor( Request $request ){
        // return response()->json([
        //     "role"=>$request->input("doctor_role_id")
        // ]);
        $request->validate([
            "doctor_address"=>"required",
            "doctor_name"=>"required|min:3",
            "doctor_phone"=>"required|min:10",
            "doctor_email"=>"required|email",
            "doctor_role_id"=>"required",
            "department_id"=>"required",
            "doctor_dob"=>"required|date",
            "doctor_pob"=>"required",
            "doctor_password"=>"required|min:8",
        ]);

        try{
            $auth = DB::table('doctors_tb')->where("doctor_email", "=", $request->input("doctor_email"))->get()->first();
            if( $auth ){
                return response()->redirectTo("/admin/doctor?tab=new&message=Email Already Added");
            }else{
                DB::table("doctors_tb")->insert([
                    "doctor_name"=> strtolower($request->input("doctor_name")),
                    "doctor_address"=>$request->input("doctor_address"),
                    "doctor_phone"=>$request->input("doctor_phone"),
                    "doctor_email"=>$request->input("doctor_email"),
                    "doctor_password"=>Hash::make($request->input("doctor_password")),
                    "doctor_role_id"=>$request->input("doctor_role_id"),
                    "doctor_pob"=>$request->input("doctor_pob"),
                    "doctor_dob"=>$request->input("doctor_dob"),
                    "department_id"=>$request->input("department_id"),
                ]);
                return response()->redirectTo("/admin/doctor?tab=new&message=Added Successfully");
            }
        }
        catch(Exception $ex){
            dd($ex);
            // return response()->redirectTo("/admin/doctor?tab=new&message=Added Failed");
        }

    }

    public function SearchDoctor( Request $request ,$name ){

        try{
            $datas = DB::select("SELECT * FROM doctors_tb dc
            LEFT JOIN doctor_roles_tb dr ON dr.doctor_role_id = dc.doctor_role_id
            LEFT JOIN departments_tb dt ON dt.department_id = dc.department_id
            WHERE dc.doctor_name LIKE ? ", [ "%". $name ."%" ]);
            return response()->json([
                "message"=>'Searching successfully',
                "datas"=>$datas
            ]);
        }
        catch(Exception $ex){
            return response()->json([
                "message"=>'Searching failed',
                "error"=>$ex,
                "datas"=>[]
            ]);
        }

    }

    public function DeleteDoctor( Request $request, $id ){
        try{
            $admin_component = new AdminComponent();
            if( $admin_component->isAdmin($request->cookie("isData")) ){
                DB::delete("DELETE FROM doctors_tb dc
                    USING doctor_roles_tb dr
                    WHERE dc.doctor_role_id = dr.doctor_role_id
                    AND dc.doctor_id = ?
                    AND dr.doctor_role_name <> ?; " , [ $id , "admin" ]);
                return response()->json([
                    "message"=>"Deleted Successfully"
                ], 201);
            }else{
                return response()->json([
                    "message"=>"Not allowed"
                ],403);
            }
        }
        catch(Exception $ex){
            return response()->json([
                "message"=>"Deleted Failed",
                "error"=>$ex
            ],301);
        }
    }

    public function UpdateDoctorById(Request $request, $id){
        $request->validate([
            "doctor_name"=>"required:min:3",
            "doctor_address"=>"required:min:3",
            "doctor_phone"=>"required|min:8",
            "doctor_email"=>"required|email",
            "role"=>"required",
            "department"=>"required",
        ]);
        try{
            $admin_component = new AdminComponent();
            if( $admin_component->isAdmin( $request->cookie("isData") ) ){
                DB::table("doctors_tb")->where("doctor_id", $id)->update([
                    "doctor_name"=>$request->input("doctor_name"),
                    "doctor_address"=>$request->input("doctor_address"),
                    "doctor_phone"=>$request->input("doctor_phone"),
                    "doctor_email"=>$request->input("doctor_email"),
                    "doctor_role_id"=>$request->input("role"),
                    "department_id"=>$request->input("department"),
                    "updated_at"=>new DateTime()
                ]);
                return redirect("/admin/doctor?tab=update&id=".$id."&message="."Updated Successfully");
            }
            else{
                return redirect("/admin/doctor?tab=update&id=".$id."&message="."Not allowed");
            }
        }   
        catch(Exception $ex){
            return redirect("/admin/doctor?tab=update&id=".$id."&message="."Updated Failed");
        }
    }

    public function GetDoctorById( Request $request, $id ){
        try{
            $data = DB::select("SELECT dp.department_name, dp.department_id, dr.doctor_role_id ,dr.doctor_role_name,dc.* FROM doctors_tb dc
                LEFT JOIN departments_tb dp ON dc.department_id = dp.department_id
                LEFT JOIN doctor_roles_tb dr ON dr.doctor_role_id = dc.doctor_role_id
                WHERE doctor_id = ?;
            ", [$id]);

            return response()->json([
                "message"=>"Get successfully",
                "data"=>$data,
            ], 201);
            
        }
        catch(Exception $x){
            return response()->json([
                "message"=>"Get failed",
                "data"=>[],
                "error"=>$x
            ], 403);
            // return redirect("/admin/doctor?tab=update&id=".$id."&message=Get failed");
        }
    }

    public function GetDoctorViewById( Request $request, $id ){
        try{
            $page = 0;
            $limit = 1 ;
            // $limit = $request->get("limit") ? $request->get("limit") : 1 ;
            $data = DB::table('doctors_tb')
                ->leftJoin("departments_tb", "doctors_tb.department_id", "=", "departments_tb.department_id")
                ->select("doctors_tb.*",
                    DB::raw("(SELECT COUNT(*) FROM patients_tb WHERE patients_tb.doctor_id = doctors_tb.doctor_id ) as patient_count ")    
                )  
                ->where("doctors_tb.doctor_id", $id)
                ->get();
            // $data = DB::table('doctors_tb')
            // ->leftJoin("departments_tb", "doctors_tb.department_id", "=", "departments_tb.department_id")
            // ->select("doctors_tb.*", DB::raw("(SELECT json_agg( json_build_object( 'patient' , patients_tb.* , 'receptionist', (SELECT json_agg( json_build_object( 'receptionist_name', receptionist_tb.receptionist_name, 'receptionist_id', receptionist_tb.receptionist_id ) ) FROM receptionist_tb WHERE receptionist_tb.receptionist_id = patients_tb.receptionist_id ) ) ) FROM patients_tb 
            //     WHERE patients_tb.doctor_id = doctors_tb.doctor_id LIMIT  1 OFFSET 0) as patients"),
            //     DB::raw("(SELECT COUNT(*) FROM patients_tb WHERE patients_tb.doctor_id = doctors_tb.doctor_id ) as patient_count ")    
            // )  
            // ->where("doctors_tb.doctor_id", $id)
            // ->get();
            if( count($data) ){
                return response()->json([
                    "message"=>"Get successfully",
                    "data"=>$data,
                ], 201);
            }else{
                return response()->json([
                    "message"=>"Get Not Found",
                    "data"=>[],
                ], 404);
            }
            
        }
        catch(Exception $x){
            dd($x);
            return response()->json([
                "message"=>"Get failed",
                "data"=>[],
                "error"=>$x
            ], 403);
            // return redirect("/admin/doctor?tab=update&id=".$id."&message=Get failed");
        }
    }


}
