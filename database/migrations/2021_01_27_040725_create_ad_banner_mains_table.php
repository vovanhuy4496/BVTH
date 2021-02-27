<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdBannerMainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_banner_mains', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name', 255)->nullable();
			$table->string('describe', 255)->nullable();
			$table->string('image_file_name', 300)->nullable();
			$table->integer('status')->nullable()->default(0);
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
        Schema::dropIfExists('ad_banner_mains');
    }
}
