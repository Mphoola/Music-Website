<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('artist');
            $table->string('producer');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedBigInteger('downloads_count')->default('0');
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->string('location');
            $table->string('extension');
            $table->date('released_date');
            $table->string('cover_image');
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
        Schema::dropIfExists('songs');
    }
}
