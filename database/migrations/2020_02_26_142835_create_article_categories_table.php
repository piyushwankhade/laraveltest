<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_categories', function (Blueprint $table) {
            
            $table->bigIncrements('id');

            $table->unsignedInteger('category_id')->nullable();
            $table->string('title');
            $table->string('image')->nullable();
            $table->string('slug')->unique();            
            $table->enum('status', ['Published', 'Draft'])->default('Draft');
            $table->enum('approval', ['Approved', 'Pending'])->default('Pending');
            $table->unsignedInteger('order')->default(0);
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();

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
        Schema::dropIfExists('article_categories');
    }
}
