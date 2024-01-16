<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStreamersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('streamers', function (Blueprint $table) {
            $table->integer('id')->primary(); // ニコ生ユーザーIDを格納する列
            $table->string('name')->nullable(false); // ニコ生ユーザー名を格納する列
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
        Schema::dropIfExists('streamers');
    }
}
