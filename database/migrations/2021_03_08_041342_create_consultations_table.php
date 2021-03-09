<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name', 255)->nullable();
			$table->string('title', 255)->nullable();
			$table->string('phone', 255)->nullable();
			$table->string('email', 255)->nullable();
			$table->string('department', 255)->nullable();
			$table->string('doctor', 255)->nullable();
            $table->text('content')->nullable();
            $table->text('reply')->nullable();
			$table->integer('status')->nullable()->default(1);
			$table->integer('sort');
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
        Schema::dropIfExists('consultations');
    }
}
