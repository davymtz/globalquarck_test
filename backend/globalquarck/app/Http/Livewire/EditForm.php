<?php

namespace App\Http\Livewire;

use App\Models\Quiz;
use Livewire\Component;

class EditForm extends Component
{
    public $quiz;

    protected $listeners = ['deleteQuestion'];
    
    protected $rules = [
        'quiz.name' => 'required|min:5',
        'quiz.questions.*.name' => 'required|min:6',
        'quiz.questions.*.options.*.name' => 'required|min:1',
    ];

    protected $messages = [
        'quiz.questions.*.name.required' => 'La pregunta es requerida.',
        'quiz.questions.*.options.*.required' => 'La opción es requerida.',
        'quiz.questions.*.name.min' => 'La pregunta debe tener al menos 6 caracteres.',
        'quiz.questions.*.options.*.name.min' => 'La opción debe tener al menos 6 caracteres.',
    ];

    public function mount($id) {
        $this->quiz = Quiz::where('id', $id)->with(["questions" => function ($q) {
            $q->select("id","name","quiz_id")->with(["options" => function ($o) {
                $o->select("id","name","question_id");
            }]);
        }])->first(["id","name"])->toArray();
        // dd($this->quiz);
    } 

    public function addQuestion() {
        $this->validate();
        $this->quiz['questions'][] = [
            'id' => null,
            'name' => "",
            'options' => [
                ['id' => null, 'name' => ""]
            ],
        ];  
    }
    
    public function addOption($key) {
        $this->validate();
        $this->quiz['questions'][$key]['options'][] = [
            'id' => null,
            'name' => ""
        ];
    }

    public function deleteQuestion($key) {
        unset($this->quiz['questions'][$key]);
        $this->quiz['questions'] = array_values($this->quiz['questions']);
    }

    public function deleteOption($key_q,$key_op) {
        unset($this->quiz['questions'][$key_q]['options'][$key_op]);
        $this->quiz['questions'] = array_values($this->quiz['questions']);
    }

    public function saveQuiz() {
        $this->validate();
        // Insert or update quiz
        $quiz = Quiz::find($this->quiz['id']);
        $quiz->update(["name" => $this->quiz['name']]);
        // Delete data that is not in the array
        $questions_delete = $quiz->questions()
            ->whereNotIn("id",array_column($this->quiz['questions'],"id"))->get();
        if($questions_delete->count() > 0) {
            $questions_delete->each(function ($question) {
                $question->options()->delete();
                $question->delete();
            });
        }
        // Insert or update questions
        foreach($this->quiz['questions'] as $question) {
            $q_result = null;
            if(is_null($question['id'])) {
                $q_result = $quiz->questions()->create(['name' => $question['name']]);
            } else {
                $q_result = $quiz->questions()->where("id", $question['id'])->first();
                $q_result->update(['name' => $question['name']]);
            }
            // Delete data that is not in the array
            $options_delete = $q_result->options()
                ->whereNotIn("id",array_column($question['options'],"id"))->get();
            if($options_delete->count() > 0) {
                // dd($options_delete->toArray());
                $options_delete->each(function ($opt){
                    $opt->delete();
                });
            }
            // Insert or update options
            foreach($question['options'] as $option) {
                // Create or update action
                if(is_null($option['id'])) {
                    $q_result->options()->create(['name' => $option['name']]);
                } else {
                    $q_option = $q_result->options()->where("id", $option["id"])->first();
                    $q_option->update(['name' => $option['name']]);
                }
            }
        }

        session()->flash('success', "Encuesta actualizada con éxito");
        return redirect()->to('/quiz');
    }

    public function render()
    {
        return view('livewire.edit-form')->layout("quiz.edit_quiz");
    }
}
