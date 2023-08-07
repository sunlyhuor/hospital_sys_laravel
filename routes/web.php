<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DepartmentAdmin;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\ReceptionistController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\Patient\PatientController;
use App\Http\Middleware\AdminMiddleware;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

//Test
Route::get("/tests", function(){
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
                    ->get();

    return response()->json(["datas" => $datas]);
});


// Admin
    Route::middleware([AdminMiddleware::class])->group(function (){

        Route::get("/admin", function(){
            return redirect("/admin/dashboard");
        });
        Route::get("/admin/dashboard", [AdminController::class,"index"]);
        //  Doctor
            Route::get("/admin/doctor", [DoctorController::class, "index"]);
            Route::get( "/admin/get/doctor", [ DoctorController::class, "GetDoctor" ] );
            Route::post( "/admin/add/doctor", [ DoctorController::class, "AddDoctor" ] );
            Route::get( "/admin/search/doctor/{name}", [ DoctorController::class, "SearchDoctor" ] );
            Route::post( "/admin/delete/doctor/{id}", [ DoctorController::class, "DeleteDoctor" ] );
            Route::post( "/admin/update/doctor/{id}", [ DoctorController::class, "UpdateDoctorById" ] );
            Route::get( "/admin/get/doctor/{id}", [ DoctorController::class, "GetDoctorById" ] );
            Route::get( "/admin/get/view/doctor/{id}", [ DoctorController::class, "GetDoctorViewById" ] );
        // Department
            Route::get("/admin/department", [DepartmentAdmin::class,"department"]);
            Route::post("/admin/add/department", [DepartmentAdmin::class, "AddDepartment"]);
            Route::get("/admin/get/department", [DepartmentAdmin::class, "GetDepartment" ]);
            Route::post("/admin/delete/department/{id}", [ DepartmentAdmin::class, "DeleteDepartment" ]);
            Route::get("/admin/get/department/{id}", [DepartmentAdmin::class, "GetDepartmentById"]);
            Route::post("/admin/update/department/{id}", [DepartmentAdmin::class, "UpdateDepartmentById"]);
            Route::get("/admin/search/department/{name}", [DepartmentAdmin::class , "SearchDepartmentByName"]);
        // Receptionist
            Route::get("/admin/receptionist", [ ReceptionistController::class, "index" ]);
            Route::post("/admin/add/receptionist", [ ReceptionistController::class, "AddReceptionist" ]);
            Route::get("/admin/get/receptionist", [ReceptionistController::class, "GetReceptionist"]);
            Route::get("/admin/search/receptionist/{name}", [ReceptionistController::class, "SearchReceptionist"]);
            Route::get("/admin/get/receptionist/{id}", [ReceptionistController::class, "GetReceptionistById"]);
            Route::post("/admin/update/receptionist/{id}", [ReceptionistController::class, "UpdateReceptionist"]);
    });
    Route::get('/admin/private/add/{name}/{email}/{password}/{phone}/{dob}/{pob}/{address}/{type}/{department}/{key}', [AdminController::class ,"createAdmin"]);

// Login
    Route::get("/login", [LoginController::class, "index"]);
    Route::post("/loginhandle", [LoginController::class, "LoginHandle"])->name("loginhandle");

// Logout
    Route::get("/logout", [ LogoutController::class, "index" ]);


// Patient
    Route::get("/patient/get/patient_by_doctor/{id}", [PatientController::class ,"getPatientByDoctorId"]);