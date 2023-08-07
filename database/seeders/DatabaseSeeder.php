<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_methods_tb')->insert([
            ["payment_method_name"=>"cash", "created_at"=> new DateTime(), "updated_at"=> new DateTime()],
            ["payment_method_name"=>"បសស", "created_at"=> new DateTime(), "updated_at"=> new DateTime()]
        ]);

        DB::table("doctor_roles_tb")->insert([
            ["doctor_role_name"=>"doctor", "created_at"=> new DateTime(),"updated_at"=>new DateTime() ],
            ["doctor_role_name"=>"admin", "created_at"=> new DateTime(), "updated_at"=>new DateTime()]
        ]);

        DB::table('receptionist_roles_tb')->insert([
            ["receptionist_role_name"=>"receptionist","created_at"=>new DateTime(), "updated_at"=>new DateTime()],
            ["receptionist_role_name"=>"manager","created_at"=>new DateTime(), "updated_at"=>new DateTime()],
        ]);
        DB::table('departments_tb')->insert([
            ["department_name"=>"admin","created_at"=>new DateTime(), "updated_at"=>new DateTime()],
        ]);
    }
}
