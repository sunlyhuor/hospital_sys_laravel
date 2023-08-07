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
        Schema::create('receptionist_tb', function (Blueprint $table) {
            $table->id("receptionist_id");
            $table->string("receptionist_name", 30)->nullable(false);
            $table->string("receptionist_address", 150)->nullable(true);
            $table->string("receptionist_phone", 20)->nullable(true);
            $table->string("receptionist_email", 50)->nullable(false);
            $table->string("receptionist_profile", 250)->nullable(true);
            $table->string("receptionist_password", 250)->nullable(false);
            $table->unsignedBigInteger("receptionist_role_id");
            $table->foreign("receptionist_role_id")->references("receptionist_role_id")->on("receptionist_roles_tb");
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
        Schema::dropIfExists('receptionist_tb');
    }
};
