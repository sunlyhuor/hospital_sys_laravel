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
        Schema::create('patients_tb', function (Blueprint $table) {
            $table->id("patient_id");
            $table->string("patient_name", 50)->nullable(false);
            $table->string("patient_email", 50)->nullable(true);
            $table->string("patient_address", 250)->nullable(false);
            $table->string("patient_phone", 50)->nullable(false);
            $table->string("patient_sex", 10)->nullable(true);
            $table->string("patient_blood_group",5)->nullable(true);
            $table->date("patient_dob")->nullable(true);
            $table->unsignedBigInteger("doctor_id");
            $table->foreign("doctor_id")->references("doctor_id")->on("doctors_tb");
            $table->unsignedBigInteger("receptionist_id");
            $table->foreign("receptionist_id")->references("receptionist_id")->on("receptionist_tb");
            // $table->unsignedBigInteger("payment_id");
            // $table->foriegn( "payment_id" )->references("payment_id")->on("payments_tb");
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
        Schema::dropIfExists('patients_tb');
    }
};
