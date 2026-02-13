<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;

Route::get('/', [QuizController::class, 'index'])->name('quiz.index');
Route::get('/quiz/create', [QuizController::class, 'create'])->name('quiz.create');
Route::post('/quiz', [QuizController::class, 'store'])->name('quiz.store');
Route::get('/quiz/{quiz}', [QuizController::class, 'show'])->name('quiz.show');
Route::get('/quiz/{quiz}/edit', [QuizController::class, 'edit'])->name('quiz.edit');
Route::delete('/quiz/{quiz}', [QuizController::class, 'destroy'])->name('quiz.destroy');
