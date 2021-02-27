<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorBvthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_bvths', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('position')->nullable();
            $table->string('specialized')->nullable();
            $table->string('experience')->nullable();
            $table->string('language')->nullable();
            $table->text('content')->nullable();
            $table->integer('status')->nullable()->default(0);
			$table->integer('sort')->nullable();
            $table->json('departments')->nullable();
			$table->string('image_file_name', 300)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctor_bvths');
    }
}
