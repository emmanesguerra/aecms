<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactUsStoreHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_us_store_hours', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('contact_us_id');
            $table->string('day', 20);
            $table->string('start', 20);
            $table->string('end', 20);
            
            $table->foreign('contact_us_id')->references('id')->on('contact_us')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_us_store_hours');
    }
}
