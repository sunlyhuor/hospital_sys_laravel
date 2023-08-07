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
        Schema::create('doctor_roles_tb', function (Blueprint $table) {
            $table->id("doctor_role_id");
            $table->string("doctor_role_name", 15)->nullable(false);
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
        Schema::dropIfExists('doctor_roles_tb');
    }
};
