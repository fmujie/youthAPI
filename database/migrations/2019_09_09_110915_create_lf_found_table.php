<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLfFoundTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lf_found', function (Blueprint $table) {
            $table->increments('id');
            $table->string('found_name', 36);
            $table->string('found_time', 10);
            $table->string('found_place', 64);
            $table->string('found_detail', 255);
            $table->string('found_img', 100);
            $table->string('found_person', 36);
            $table->string('found_phone', 15);
            $table->integer('found_status')->defaoult(1);
            $table->timestamps();
            $table->time('return_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lf_found');
    }
}
