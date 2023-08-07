<?php

namespace App\Http\Controllers\Admin;

use App\Http\Components\AdminComponent;
use App\Http\Controllers\Controller;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ReceptionistController extends Controller
{

    public function index(Request $request){
        $receptionist_roles = DB::table('receptionist_roles_tb')->get();
        $count = DB::select("SELECT COUNT(*) FROM receptionist_tb");
        return view("admin/ReceptionistAdmin")->with(["roles"=>$receptionist_roles])->with(["count"=>$count[0]->count]);
    }

    public function AddReceptionist( Request $request ){
        $request->validate(
            [
                "receptionist_name"=>"required",
                "receptionist_address"=>"required",
                "receptionist_email"=>"required|email",
                "receptionist_phone"=>"required|numeric",
                "receptionist_password"=>"required|min:8",
                "receptionist_role_id"=>"required",
                ]
            );
        try{
            $admin_component = new AdminComponent();  
            if( $admin_component->isAdmin( $request->cookie("isData") ) ){
                if( !$admin_component->checkEmailAlreadyUsed("receptionist", $request->input("receptionist_email") ) ){
                    DB::table('receptionist_tb')->insert([
                        "receptionist_name"=> strtolower($request->input("receptionist_name")) ,
                        "receptionist_address"=>$request->input("receptionist_address"),
                        "receptionist_email"=>$request->input("receptionist_email"),
                        "receptionist_phone"=>$request->input("receptionist_phone"),
                        "receptionist_password"=> Hash::make($request->input("receptionist_password")),
                        "receptionist_role_id"=>$request->input("receptionist_role_id"),
                        "created_at"=>new DateTime(),
                        "updated_at"=>new DateTime(),
                    ]);
                    return redirect("/admin/receptionist?tab=new&message=Added Successfully");
                }else{
                    return redirect("/admin/receptionist?tab=new&message=Email already used");
                }
            }else{
                return redirect("/admin/receptionist?tab=new&message=Not allowed");
            }
        }
        catch(Exception $ex){
            return redirect("/admin/receptionist?tab=new&message=Added Failed");
        }
    }

    public function GetReceptionist( Request $request ){
        try{
            $limit = $request->get("limit") ? $request->get("limit") : 10;
            $page = $request->get("page") ? $request->get("page") : 1;
            $datas = DB::select("SELECT r.*,rr.receptionist_role_name,rr.receptionist_role_id FROM receptionist_tb r
            LEFT JOIN receptionist_roles_tb rr ON rr.receptionist_role_id = r.receptionist_role_id
            LIMIT ? OFFSET ?", [ $limit, ( $page - 1 ) * $limit ]);
            return response()->json([
                "message"=>"Got Successfully",
                "datas"=>$datas
            ]);
        }
        catch(Exception $ex){
            return response()->json([
                "message"=>"Got Failed",
                "error"=>$ex,
                "datas"=>[]
            ]);
        }
    }

    public function SearchReceptionist( Request $request, $name ){
        try{
            $datas = DB::select("SELECT r.*,rr.receptionist_role_name,rr.receptionist_role_id FROM receptionist_tb r
            LEFT JOIN receptionist_roles_tb rr ON rr.receptionist_role_id = r.receptionist_role_id
            WHERE r.receptionist_name LIKE ? ", ["%".$name."%"] );
            return response()->json([
                "message"=>"Searching Successfully",
                "datas"=>$datas,
            ]);
        }
        catch(Exception $ex){
            return response()->json([
                "message"=>"Searching Failed",
                "datas"=>[],
                "error"=> $ex
            ]);
        }
    }

    public function UpdateReceptionist(Request $request, $id){
        $request->validate([
            "receptionist_name"=>"required",
            "receptionist_address"=>"required",
            "receptionist_phone"=>"required|numeric",
            "receptionist_email"=>"required|email",
            "receptionist_role_id"=>"required",
        ]);

        try{
            $admin_component = new AdminComponent();
            if($admin_component->isAdmin( $request->cookie("isData") )){
                DB::table("receptionist_tb")->where("receptionist_id", $id)->update([
                    "receptionist_name"=>$request->input("receptionist_name"),
                    "receptionist_address"=>$request->input("receptionist_address"),
                    "receptionist_phone"=>$request->input("receptionist_phone"),
                    "receptionist_email"=>$request->input("receptionist_email"),
                    "receptionist_role_id"=>$request->input("receptionist_role_id"),
                    // "updated_at"=>new DateTime()
                ]);
                return redirect("/admin/receptionist?tab=update&id=".$id."&message=Updated Successfully");
            }else{
                return redirect("/admin/receptionist?tab=update&id=".$id."&message=Not allowed");
            }
        }
        catch(Exception $ex){
            // dd($ex);
            return redirect("/admin/receptionist?tab=update&id=".$id."&message=Updated failed");
        }

    }

    public function GetReceptionistById(Request $request, $id){
        try{
            $datas = DB::select("SELECT r.*,rr.receptionist_role_name,rr.receptionist_role_id FROM receptionist_tb r
                LEFT JOIN receptionist_roles_tb rr ON rr.receptionist_role_id = r.receptionist_role_id
                WHERE r.receptionist_id = ? ", [ $id ]);
            return response()->json([
                "datas"=>$datas
            ], 201);
        }
        catch(Exception $ex){
            return response()->json([
                "datas"=>[]
            ], 301);
        }
    }

}
