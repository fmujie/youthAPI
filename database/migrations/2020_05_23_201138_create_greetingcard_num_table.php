<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB; 

class CreateGreetingcardNumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 创建毕业贺卡计数表
        Schema::create('greetingcard_num', function (Blueprint $table) {
            $table->increments('gcn_id');
            $table->string('gcn_tag',20)->default('')->comment('贺卡标签');
            $table->string('gcn_name',50)->default('')->comment('贺卡中文标签');
            $table->integer('gcn_num')->default(0)->comment('贺卡计数');
            $table->timestamps();
        });
        DB::insert("INSERT INTO `greetingcard_num` (`gcn_id`, `gcn_tag`, `gcn_name`, `gcn_num`, `created_at`, `updated_at`) VALUES 
        (NULL, 'roommate', '致舍友', '0', NULL, NULL),
        (NULL, 'tutor', '致辅导员', '0', NULL, NULL),
        (NULL, 'teacher', '致老师', '0', NULL, NULL),
        (NULL, 'driver', '致小绿龙师傅', '0', NULL, NULL),
        (NULL, 'lover', '致最爱的你', '0', NULL, NULL),
        (NULL, 'myself', '致自己', '0', NULL, NULL),
        (NULL, 'freshmen', '致学弟学妹们', '0', NULL, NULL),
        (NULL, 'suguan', '致宿管阿姨', '0', NULL, NULL),
        (NULL, 'classmates', '致同班同学', '0', NULL, NULL),
        (NULL, 'friends', '致最好朋友', '0', NULL, NULL),
        (NULL, 'leader', '致班委', '0', NULL, NULL),
        (NULL, 'cook', '致食堂的叔叔阿姨', '0', NULL, NULL),
        (NULL, 'waimai', '致快递小哥', '0', NULL, NULL),
        (NULL, 'baoan', '致门卫叔叔', '0', NULL, NULL)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('greetingcard_num');
    }
}
