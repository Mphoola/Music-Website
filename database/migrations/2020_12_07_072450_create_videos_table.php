<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('artist');
            $table->string('producer');
            $table->unsignedInteger('category_id');
            $table->string('location');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('u_name')->nullable();
            $table->date('released_date');
            $table->string('cover_image');
            $table->boolean('verified')->default(false);
            $table->enum('market', ['free', 'sale']);
            $table->unsignedBigInteger('amount')->default('0');
            $table->uuid('uuid')->nullable();
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
        Schema::dropIfExists('videos');
    }
}
