<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionsInQuiz extends Model
{
    use HasFactory;
    
    protected $table="questions_in_quiz";

    protected $fillable = ['name'];

    public function quiz() {
        return $this->belongsTo(Quiz::class,"quiz_id","id");
    }

    public function options() {
        return $this->hasMany(OptionsInQuestion::class,"question_id","id");
    }
}
