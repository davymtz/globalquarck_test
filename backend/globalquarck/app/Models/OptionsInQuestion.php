<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionsInQuestion extends Model
{
    use HasFactory;

    protected $table="options_in_question";

    protected $fillable = ['name'];

    public function question() {
        return $this->belongsTo(QuestionsInQuiz::class,"question_id","id");
    }
}
