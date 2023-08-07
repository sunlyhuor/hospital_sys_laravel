<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    public function getPatientByDoctorId(Request $request, $id){
        $page = $request->get("page") ? $request->get("page") : 1;
        $limit = $request->get("limit") ? $request->get("limit") : 1;
        try{
            $datas = DB::table('patients_tb')
                ->leftJoin("doctors_tb", "doctors_tb.doctor_id", "=", "patients_tb.doctor_id")
                ->leftJoin("receptionist_tb", "receptionist_tb.receptionist_id", "=", "patients_tb.receptionist_id")
                ->select("patients_tb.*", "receptionist_tb.receptionist_name")
                ->where("doctors_tb.doctor_id", $id)
                ->limit( $limit )
                ->offset( ( $page - 1 ) * $limit )
                ->get();
            if( count( $datas ) > 0 ){
                return response()->json([
                    "message"=>"Get Successfully",
                    "datas"=>$datas,
                ], 201);
            }else{
                return response()->json([
                    "message"=>"Get Not Found doctor",
                    "datas"=>[],
                ], 404);
            }
        }
        catch( Exception $ex ){
            return response()->json([
                "message"=>"Get failed",
                "datas"=>[],
                "error"=>$ex
            ], 403);
        }
    }
}
