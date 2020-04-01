<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemsgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remsgs', function (Blueprint $table) {
            $table->increments('id');
//            $table->integer('boards_id');
            $table->integer('msg_id');
            $table->string('remsg_user'); //suser_id
            $table->string('remsg');
            $table->timestamp('create_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('remsgs');
    }
}
