<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;

Route::get('/', [QuizController::class, 'index'])->name('quiz.index');
Route::get('/quiz/create', [QuizController::class, 'create'])->name('quiz.create');
Route::post('/quiz', [QuizController::class, 'store'])->name('quiz.store');
Route::get('/quiz/{quiz}', [QuizController::class, 'show'])->name('quiz.show');
Route::get('/quiz/{quiz}/edit', [QuizController::class, 'edit'])->name('quiz.edit');
Route::put('/quiz/{quiz}', [QuizController::class, 'update'])->name('quiz.update');
Route::delete('/quiz/{quiz}', [QuizController::class, 'destroy'])->name('quiz.destroy');

// Quiz taking routes
Route::get('/quiz/{quiz}/take', [QuizController::class, 'take'])->name('quiz.take');
Route::post('/quiz/{quiz}/submit', [QuizController::class, 'submit'])->name('quiz.submit');
Route::get('/quiz/{quiz}/attempt/{attempt}', [QuizController::class, 'results'])->name('quiz.results');

// History routes
Route::get('/history', [QuizController::class, 'history'])->name('quiz.history');
Route::get('/user/{user}/attempts', [QuizController::class, 'userAttempts'])->name('user.attempts');

// Question management routes
Route::post('/quiz/{quiz}/question', [QuizController::class, 'addQuestion'])->name('question.add');
Route::put('/quiz/{quiz}/question/{question}', [QuizController::class, 'updateQuestion'])->name('question.update');
Route::delete('/quiz/{quiz}/question/{question}', [QuizController::class, 'deleteQuestion'])->name('question.delete');
