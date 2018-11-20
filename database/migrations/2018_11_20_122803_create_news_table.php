<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code');
            $table->boolean('active');
            $table->dateTime('publishing_date');
            $table->text('description');
            $table->string('image');
            $table->text('preview');
            $table->string('preview_image');
            $table->timestamps();

            $table->unique('code');
        });

        Schema::create('news_publishings', function (Blueprint $table) {
            $table->unsignedInteger('news_id');
            $table->unsignedInteger('publishing_id');

            $table->foreign('news_id')->references('id')->on('news');
            $table->foreign('publishing_id')->references('id')->on('publishing');

            $table->primary(['news_id', 'publishing_id']);
        });

        Schema::create('news_translate', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('news_id');
            $table->string('language');
            $table->string('name');
            $table->string('code');
            $table->text('description');
            $table->string('image');
            $table->text('preview');
            $table->string('preview_image');
            $table->timestamps();

            $table->unique('code');

            $table->foreign('news_id')->references('id')->on('news');
            $table->foreign('language')->references('code')->on('language');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
