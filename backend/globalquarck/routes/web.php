<?php

use App\Http\Controllers\QuizController;
use App\Http\Livewire\EditForm;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// Encuestas
Route::group(['prefix' => "/quiz"], function () {
    Route::get("/", [QuizController::class,'index'])->name("quiz.index");
    Route::get("/create", [QuizController::class,'create'])->name("quiz.create");
    Route::get("/{id}", [QuizController::class,'show'])->name("quiz.show");
    // Livewire
    Route::get("/{id}/edit", EditForm::class)->name("quiz.edit");
    Route::delete("/{quiz}", [QuizController::class,'destroy'])->name("quiz.destroy");
});