<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_descriptions', function (Blueprint $table) {
            $table->increments('id');
			$table->string('title', 255)->nullable();
            $table->text('content')->nullable();
			$table->string('address', 255)->nullable();
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
        Schema::dropIfExists('contact_descriptions');
    }
}
