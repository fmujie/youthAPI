<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWishTreeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wish_tree', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_name')->default('匿名');
            $table->string('con_method')->nullable();
            $table->string('con_detail')->nullable();
            $table->integer('user_demand')->default(0);
            $table->string('wish')->nullable();
            $table->string('regret')->nullable();
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
        Schema::dropIfExists('wish_tree');
    }
}
