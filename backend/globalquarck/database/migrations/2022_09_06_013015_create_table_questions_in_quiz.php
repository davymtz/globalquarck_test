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
        Schema::create('questions_in_quiz', function (Blueprint $table) {
            $table->id();
            $table->string("name",300);
            $table->unsignedBigInteger("quiz_id");
            $table->timestamps();
            $table->foreign("quiz_id")->references("id")->on("quiz");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("questions_in_quiz", function(Blueprint $table) {
            $table->dropForeign(["quiz_id"]);
        });
        Schema::dropIfExists('questions_in_quiz');
    }
};
