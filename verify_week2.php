<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$quiz = \App\Models\Quiz::where('title', 'like', '%Week 2%')->first();

if ($quiz) {
    echo "✓ Week 2 Quiz created successfully!\n";
    echo "  Title: " . $quiz->title . "\n";
    echo "  Description: " . $quiz->description . "\n";
    echo "  Total Questions: " . $quiz->total_questions . "\n";
    echo "  Questions in DB: " . $quiz->questions->count() . "\n";
    echo "  Total Answers: " . $quiz->questions->sum(fn($q) => $q->answers->count()) . "\n\n";
    
    echo "Sample Questions:\n";
    foreach ($quiz->questions->take(3) as $question) {
        echo "  Q" . $question->question_number . ": " . substr($question->question_text, 0, 60) . "...\n";
        foreach ($question->answers as $answer) {
            $correct = $answer->is_correct ? " ✓" : "";
            echo "    " . strtoupper($answer->answer_letter) . ") " . substr($answer->answer_text, 0, 50) . "$correct\n";
        }
    }
} else {
    echo "✗ Week 2 Quiz not found!\n";
}
