<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAnswersTable extends Migration
{
    public function up()
    {
        Schema::create('user_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_answer_title');
            $table->bigInteger('result_id')->unsigned()->nullable();
            $table->bigInteger('answer_id')->unsigned()->nullable();

            $table->index('result_id');
            $table->foreign('result_id')->references('id')->on('results')->onDelete('cascade');
            $table->index('answer_id');
            $table->foreign('answer_id')->references('id')->on('answers')->onDelete('cascade');
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_answers');
    }
}
