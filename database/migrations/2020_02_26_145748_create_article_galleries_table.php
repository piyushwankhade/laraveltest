<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_galleries', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedInteger('article_id');
            $table->string('image');
            $table->string('caption')->nullable();
            $table->boolean('default')->default(false);
            
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
        Schema::dropIfExists('article_galleries');
    }
}
