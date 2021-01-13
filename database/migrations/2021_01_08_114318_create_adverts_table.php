<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adverts', function (Blueprint $table) {
            $table->id();
            $table->string('alt');
            $table->string('url');
            $table->string('image_path')->nullable();
            $table->integer('views')->default(0);
            $table->integer('clicks')->default(0);
            $table->boolean('active')->default(true);
            $table->integer('advert_category_id')->unsigned();
            $table->timestamp('viewed_at')->nullable();
            $table->timestamps();

            // $table->foreign('advert_category_id')
            //     ->references('id')
            //     ->on('advert_categories')
            //     ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adverts');
    }
}
