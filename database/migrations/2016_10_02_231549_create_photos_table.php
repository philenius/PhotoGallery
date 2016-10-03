<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('location');
            $table->string('author');
            $table->string('file_name_thumbnail')->default('NULL');
            $table->string('file_name_compressed')->default('NULL');
            $table->string('file_name_original');
            $table->integer('subject_id')->unsigned();
            $table->foreign('subject_id')->references('id')->on('photo_subjects');
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
        Schema::dropIfExists('photos');
    }
}
