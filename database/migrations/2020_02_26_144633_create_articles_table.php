<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->string('title');
            $table->string('author')->nullable();
            $table->string('image')->nullable();
            $table->string('youtube_url')->nullable();
            $table->timestamp('posted_at')->nullable();
            $table->text('description')->nullable();
            $table->longText('body')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->unsignedInteger('views')->default(0);
            $table->string('slug')->unique();            
            $table->enum('status', ['Published', 'Draft'])->default('Draft');
            $table->enum('approval', ['Approved', 'Pending'])->default('Pending');
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
        Schema::dropIfExists('articles');
    }
}
