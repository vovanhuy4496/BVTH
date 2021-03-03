<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceTechnicalServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_technical_services', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name', 255)->nullable();
			$table->string('group', 255)->nullable();
			$table->string('unit', 255)->nullable();
			$table->string('price', 255)->nullable();
			$table->string('price_bhyt', 255)->nullable();
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
        Schema::dropIfExists('price_technical_services');
    }
}
