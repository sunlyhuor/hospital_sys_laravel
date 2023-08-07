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
        Schema::create('departments_tb', function (Blueprint $table) {
            $table->id("department_id");
            $table->string( "department_name", 50 )->nullable(false);
            $table->string( "department_description", 50 )->nullable(true);
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
        Schema::dropIfExists('departments_tb');
    }
};
