<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoBvthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_bvths', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
			$table->string('image_file_name', 300)->nullable();
            $table->json('videos')->nullable();
            $table->string('folder')->nullable();
            $table->integer('status')->nullable()->default(0);
			$table->integer('sort')->nullable();
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
        Schema::dropIfExists('video_bvths');
    }
}
