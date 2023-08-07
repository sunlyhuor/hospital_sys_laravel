<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors_tb', function (Blueprint $table) {
            $table->id("doctor_id");
            $table->string("doctor_name", 50)->nullable(false);
            $table->string("doctor_address", 250)->nullable(false);
            $table->string("doctor_phone", 50)->nullable(false);
            $table->string("doctor_email", 50)->nullable(false);
            $table->string("doctor_profile", 50)->nullable(true);
            $table->string("doctor_password", 250)->nullable(true);
            $table->string("doctor_pob", 250)->nullable(true);
            $table->date("doctor_dob", 250)->nullable(false);
            $table->unsignedBigInteger("department_id");
            $table->foreign("department_id")->references("department_id")->on("departments_tb");
            $table->unsignedBigInteger("doctor_role_id");
            $table->foreign("doctor_role_id")->references("doctor_role_id")->on("doctor_roles_tb");
            $table->timestamps(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctors_tb');
    }
};
