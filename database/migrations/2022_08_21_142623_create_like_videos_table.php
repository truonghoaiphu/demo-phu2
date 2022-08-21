<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('like_videos', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('share_video_id');
            $table->enum('reaction', ['like', 'dislike']);
            $table->foreign('share_video_id')->references('id')->on('share_videos')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('like_videos');
    }
};
