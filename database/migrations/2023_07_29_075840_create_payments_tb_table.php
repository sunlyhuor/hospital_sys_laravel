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
        Schema::create('payments_tb', function (Blueprint $table) {
            $table->id("payment_id");
            $table->decimal("payment_amount", 9, 3)->nullable(false);
            $table->unsignedBigInteger("payment_method_id");
            $table->foreign("payment_method_id")->references("payment_method_id")->on("payment_methods_tb");
            $table->unsignedBigInteger("receptionist_id");
            $table->foreign("receptionist_id")->references("receptionist_id")->on("receptionist_tb");
            $table->unsignedBigInteger("patient_id");
            $table->foreign("patient_id")->references("patient_id")->on("patients_tb");
            $table->unsignedBigInteger("doctor_id");
            $table->foreign("doctor_id")->references("doctor_id")->on("doctors_tb");
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
        Schema::dropIfExists('payments_tb');
    }
};
