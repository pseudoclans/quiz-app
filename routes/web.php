<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;

Route::get('/', [QuizController::class, 'index'])->name('quiz.index');
Route::get('/quiz/create', [QuizController::class, 'create'])->name('quiz.create');
Route::post('/quiz/store', [QuizController::class, 'store'])->name('quiz.store');
Route::get('/quiz/{id}', [QuizController::class, 'show'])->name('quiz.show');
Route::post('/quiz/{id}/submit', [QuizController::class, 'submit'])->name('quiz.submit');
Route::get('/quiz/{id}/edit', [QuizController::class, 'edit'])->name('quiz.edit');
Route::post('/quiz/{id}/update', [QuizController::class, 'update'])->name('quiz.update');
Route::delete('/quiz/{id}', [QuizController::class, 'destroy'])->name('quiz.destroy');
