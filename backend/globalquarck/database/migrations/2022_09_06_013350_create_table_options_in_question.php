<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options_in_question', function (Blueprint $table) {
            $table->id();
            $table->string("name",100);
            $table->unsignedBigInteger("question_id");
            $table->timestamps();
            $table->foreign("question_id")->references("id")->on("questions_in_quiz");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("options_in_questions", function (Blueprint $table) {
            $table->dropForeign(["question_id"]);
        });
        Schema::dropIfExists('options_in_question');
    }
};
