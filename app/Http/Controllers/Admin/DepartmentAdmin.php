<?php

namespace App\Http\Controllers\Admin;

use App\Http\Components\AdminComponent;
use App\Http\Controllers\Controller;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentAdmin extends Controller
{
    
    public function department(Request $request){

        $count = DB::select("SELECT COUNT(*) FROM departments_tb");
        // return response()->json(["count"=>$count[0]->count]);
        if( $request->cookie("isAdmin") && $request->cookie("isLogin") && $request->cookie("isData") ){
            return view("admin/DepartmentAdmin")->with("count", strval( $count[0]->count ) );
        }else{
            return redirect("/logout");
        }

    }

    public function AddDepartment(Request $request){
        $request->validate([
            "department_name"=>"required|min:1"
        ]);

        if( $request->cookie("isData") && $request->cookie("isAdmin") && $request->cookie("isLogin") ){

            // $auth = DB::select("select * from doctors_tb dt inner join doctor_roles_tb drt on dt.doctor_role_id = drt.doctor_role_id where drt.doctor_role_name = ? and dt.doctor_email = ?", ["admin", $request->cookie("isData")]);
            // return response()->json(["datas"=>$auth]);
            $admin_component = new AdminComponent();
            if( $admin_component->isAdmin($request->cookie("isData") ) ){
                try{
                    DB::insert("INSERT INTO departments_tb( department_name, department_description, created_at, updated_at ) VALUES(?, ?, ?, ?)", [ strtolower($request->input("department_name")), $request->input("department_description"), new DateTime(), new DateTime() ]);
                    return redirect("/admin/department?tab=new&message=Added successfully");
                }catch( Exception $e ){
                    // dd($e);
                    return redirect("/admin/department?tab=new&message=Added failed");
                }
            }else{
                return redirect("/logout");
            }
        }else{
            return redirect("/logout");
        }

    }

    public function GetDepartment( Request $request ){

        $page = $request->get("page") ? $request->get("page") : 1;
        $limit = $request->get("limit") ? $request->get("limit") : 10;
        // $limit = 10;

        try{
                $datas = DB::table('departments_tb')
                    ->leftJoin("doctors_tb", "doctors_tb.department_id", "=", "departments_tb.department_id")
                    ->select('departments_tb.*', DB::raw("(SELECT json_agg(json_build_object('doctor_name', doctors_tb.doctor_name,
                        'doctor_id', doctors_tb.doctor_id))
                        FROM doctors_tb WHERE doctors_tb.department_id = departments_tb.department_id) as doctors"),
                        DB::raw("(SELECT count(*) FROM doctors_tb WHERE doctors_tb.department_id = departments_tb.department_id) as doctor_count"),
                        DB::raw("(SELECT count(*) FROM patients_tb 
                            INNER JOIN doctors_tb ON doctors_tb.doctor_id = patients_tb.doctor_id
                            WHERE departments_tb.department_id = doctors_tb.department_id) as patient_count")
                    )
                    ->groupBy("departments_tb.department_id")
                    ->limit( $limit )
                    ->offset( ($page - 1) * $limit )
                    ->get();
            return response()->json(["datas"=>$datas,"page"=>$page, "limit"=> $limit]);

        }catch(Exception $ex){
            return response()->json(["datas"=>[],"error"=>$ex]);
        }


    }

    public function DeleteDepartment( Request $request, $id ){
        if( $request->cookie("isData") && $request->cookie("isAdmin") && $request->cookie("isLogin") ){
            $auth = DB::select("select * from doctors_tb dt inner join doctor_roles_tb drt on dt.doctor_role_id = drt.doctor_role_id where drt.doctor_role_name = ? and dt.doctor_email = ?", ["admin", $request->cookie("isData")]);
            if( $auth ){
                try{
                    DB::insert("DELETE FROM departments_tb where department_id = ?", [$id] );
                    return response()->json([
                        "message"=>"Department Deleted Successfully"
                    ]);
                    // return redirect("/admin/department?tab=new&message=Added successfully");
                }catch( Exception $e ){
                    return response()->json([
                        "message"=>"Department Deleted Failed",
                        "error"=>$e
                    ]);
                    // dd($e);
                    // return redirect("/admin/department?tab=new&message=Added failed");
                }
            }else{
                return redirect("/logout");
            }
        }else{
            return redirect("/logout");
        }
    }

    public function GetDepartmentById( Request $request, $id ){

        try{
                $data = DB::table("departments_tb")->where("department_id", "=", $id)->get()->first();
                return response()->json([
                    "data" => $data
                ]);

        }catch(Exception $x){
            return response()->json(
                [
                    "message"=>"Selected failed",
                    "error"=>$x
                ]
            );
        }

    }

    public function UpdateDepartmentById( Request $request, $id ){
        $request->validate([
            "department_name"=>"required|min:2"
        ]);
        try{ 
            $admin_component = new AdminComponent();
            if( $admin_component->isAdmin($request->cookie("isData")) ){
                
                DB::table("departments_tb")->where("department_id", "=", $id)->update([
                    "department_name"=>$request->input("department_name"),
                    "department_description"=>$request->input("department_description"),
                    "updated_at"=> new DateTime()
                ]);   
                return redirect("/admin/department?tab=update&id=".$id."&message=Updated Successfully");
            }else{
                return redirect("/admin/department?tab=update&id=".$id."&message=Not allowed");
            }
        }
        catch( Exception $ex ){
            return redirect("/admin/department?tab=update&id=".$id."&message=Updated Failed");
        }
    }

    public function SearchDepartmentByName( Request $request, $name ){

        try{

            $datas = DB::select("SELECT d.department_id, d.department_name, d.department_description, COUNT(dr.doctor_id) AS doctor_count
                FROM departments_tb d
                LEFT JOIN doctors_tb dr ON d.department_id = dr.department_id
                WHERE d.department_name LIKE ?
                GROUP BY d.department_id, d.department_name
                ORDER BY d.department_id ASC
            ", [ "%". $name ."%" ]);
            return response()->json([
                "datas"=>$datas
            ]);

        }
        catch(Exception $ex){
            return response()->json(
                [
                    "message"=>"Searched failed",
                    "error"=>$ex
                ]
            );
        }

    }

}
