<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_translations', function (Blueprint $table) {
	        $table->bigIncrements('id');
	        $table->bigInteger('article_id')->unsigned();
	        $table->integer('user_id')->unsigned();
	        $table->string('slug')->unique();
	        $table->text('title');
	        $table->text('description');
	        $table->text('body');
	        $table->string('locale')->index();
	        $table->timestamps();
	        $table->softDeletes();

	        $table->unique(['article_id','locale']);
	        $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
	        $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
        });

	    DB::statement('ALTER TABLE article_translations ADD FULLTEXT full(title, description, body)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_translations');
    }
}
