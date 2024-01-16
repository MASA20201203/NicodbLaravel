<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStreamerCommunitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('streamer_communities', function (Blueprint $table) {
            $table->id();
            $table->integer('streamer_id');
            $table->string('community_id');
            $table->timestamps();

            // 外部キー制約を設定
            $table->foreign('streamer_id')->references('id')->on('streamers')->onDelete('cascade');
            $table->foreign('community_id')->references('id')->on('communities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('streamer_communities');
    }
}
