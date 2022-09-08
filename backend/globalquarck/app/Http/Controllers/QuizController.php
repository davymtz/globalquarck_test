<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizzes = Quiz::select(['id','name'])->get();
        return view("quiz.index", compact("quizzes"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("quiz.create_quiz");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quiz_detail = Quiz::where('id', $id)->with(["questions" => function ($q) {
            $q->select("id","name","quiz_id")->with(["options" => function ($o) {
                $o->select("id","name","question_id");
            }]);
        }])->first(["id","name"]);
        // dd($quiz_detail->toArray());
        return view("quiz.detail",compact("quiz_detail"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {

    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quiz $quiz)
    {
        try {
            DB::beginTransaction();
            $quiz->questions->each(function ($question) {
                $question->options->each(function ($option) {
                    // Elimina las opciones de la pregunta seleccionada
                    $option->delete();
                });
                // Eliminar las preguntas de la encuesta seleccionada
                $question->delete();
            });
            // Eliminamos al final la encuesta
            $quiz->delete();
            DB::commit();
            // Redirigimos con éxito
            session()->flash('success', "Encuesta eliminada con éxito");
            return redirect()->to('/quiz');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
