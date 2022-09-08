<?php

namespace App\Http\Livewire;

use App\Models\Quiz;
use Livewire\Component;

class QuizForm extends Component
{
    public $name_quiz;
    public $questions;

    protected $listeners = ['deleteQuestion'];
    
    protected $rules = [
        'name_quiz' => 'required|min:5',
        'questions.*.name' => 'required|min:6',
        'questions.*.options.*' => 'required|min:1',
    ];

    protected $messages = [
        'questions.*.name.required' => 'La pregunta es requerida.',
        'questions.*.options.*.required' => 'La opción es requerida.',
        'questions.*.name.min' => 'La pregunta debe tener al menos 6 caracteres.',
        'questions.*.options.*.min' => 'La opción debe tener al menos 6 caracteres.',
    ];

    public function mount() {
        $this->name_quiz = "";
        $this->questions = [
            ['name' => '', 'options' => ['']]
        ];
    } 

    public function addQuestion() {
        $this->validate();
        $this->questions[] = [
            'name' => '',
            'options' => ['']
        ];
    }
    
    public function addOption($key) {
        $this->validate();
        $this->questions[$key]['options'][] = "";
    }

    public function deleteQuestion($key) {
        unset($this->questions[$key]);
        $this->questions = array_values($this->questions);
    }

    public function deleteOption($key_q,$key_op) {
        unset($this->questions[$key_q]['options'][$key_op]);
        $this->questions = array_values($this->questions);
    }

    public function saveQuiz() {
        $this->validate();
        // Insert quiz
        $quiz = Quiz::create(['name' => $this->name_quiz]);
        // Insert questions values
        foreach($this->questions as $question) {
            $q_result = $quiz->questions()->create(['name' => $question['name']]);
            // Insert options values
            foreach($question['options'] as $option) {
                $q_result->options()->create(['name' => $option]);
            }
        }

        session()->flash('success', "Encuesta creada con éxito");
        return redirect()->to('/quiz');
    }

    public function render()
    {
        return view('livewire.quiz-form');
    }
}
