<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Attempt;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::with('questions')->get();
        return view('quiz.index', ['quizzes' => $quizzes]);
    }

    public function create()
    {
        return view('quiz.create');
    }

    public function store(Request $request)
    {
        // Check if it's paste mode or manual mode
        if ($request->input('mode') === 'paste') {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'quiz_content' => 'required|string',
            ]);

            try {
                // Create quiz
                $quiz = Quiz::create([
                    'title' => $request->title,
                    'description' => $request->description,
                    'total_questions' => 0,
                ]);

                // Parse quiz content
                $questionsCount = $this->parseAndCreateQuestions($quiz, $request->quiz_content);

                // Update total questions
                $quiz->update(['total_questions' => $questionsCount]);

                return redirect()->route('quiz.show', $quiz->id)
                    ->with('success', "Quiz created successfully with {$questionsCount} questions!");
            } catch (\Exception $e) {
                return back()->with('error', 'Error creating quiz: ' . $e->getMessage())
                    ->withInput();
            }
        } else {
            // Manual mode - handle the old way
            $request->validate([
                'title' => 'required|string|max:255',
                'sets' => 'required|array|min:1',
            ]);

            // Create quiz from manual input
            $quiz = Quiz::create([
                'title' => $request->title,
                'description' => 'Created manually',
                'total_questions' => 0,
            ]);

            $totalQuestions = 0;
            foreach ($request->sets as $setIndex => $set) {
                foreach ($set['questions'] as $qIndex => $questionData) {
                    $totalQuestions++;
                    
                    $question = Question::create([
                        'quiz_id' => $quiz->id,
                        'question_text' => $questionData['question'],
                        'question_type' => $set['type'],
                        'question_number' => $totalQuestions,
                    ]);

                    if ($set['type'] === 'multiple_choice') {
                        foreach ($questionData['choices'] as $index => $choice) {
                            Answer::create([
                                'question_id' => $question->id,
                                'answer_text' => $choice,
                                'answer_letter' => chr(97 + $index), // a, b, c, d
                                'is_correct' => false, // Will update based on checkbox
                            ]);
                        }
                    } else {
                        Answer::create([
                            'question_id' => $question->id,
                            'answer_text' => $questionData['correct_answer'],
                            'is_correct' => true,
                        ]);
                    }
                }
            }

            $quiz->update(['total_questions' => $totalQuestions]);

            return redirect()->route('quiz.show', $quiz->id)
                ->with('success', "Quiz created successfully with {$totalQuestions} questions!");
        }
    }


    public function show($id)
    {
        $quiz = Quiz::with('questions.answers')->findOrFail($id);
        return view('quiz.show', ['quiz' => $quiz]);
    }

    public function edit($id)
    {
        $quiz = Quiz::with('questions.answers')->findOrFail($id);
        return view('quiz.edit', ['quiz' => $quiz]);
    }

    public function destroy($id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->delete();

        return redirect()->route('quiz.index')->with('success', 'Quiz deleted successfully!');
    }

    private function parseAndCreateQuestions(Quiz $quiz, string $content)
    {
        $lines = array_filter(array_map('trim', explode("\n", $content)));
        $questionCount = 0;
        $currentQuestion = null;
        $currentAnswers = [];
        $questionType = null;
        $questionNumber = 1;
        $inAnswerKey = false;
        $answerKeys = ['mc' => [], 'id' => [], 'tf' => []];
        $currentAnswerSection = null;

        // First pass: Extract answer keys
        foreach ($lines as $line) {
            if (stripos($line, 'Answer Key') !== false || stripos($line, '✅') === 0) {
                $inAnswerKey = true;
                continue;
            }

            if ($inAnswerKey) {
                // Detect which answer section
                if (stripos($line, 'Multiple Choice') !== false) {
                    $currentAnswerSection = 'mc';
                    continue;
                } elseif (stripos($line, 'Identification') !== false) {
                    $currentAnswerSection = 'id';
                    continue;
                } elseif (stripos($line, 'True/False') !== false || stripos($line, 'True or False') !== false) {
                    $currentAnswerSection = 'tf';
                    continue;
                }

                // Parse Multiple Choice: 1-B, 2-A, 3-D
                if (preg_match_all('/(\d+)-([A-Da-d])/', $line, $matches, PREG_SET_ORDER)) {
                    foreach ($matches as $match) {
                        $answerKeys['mc'][(int)$match[1]] = strtolower($match[2]);
                    }
                }
                // Parse Identification: 31. Answer text
                elseif (preg_match('/^(\d+)\.\s+(.+)$/', $line, $match)) {
                    $answerKeys['id'][(int)$match[1]] = trim($match[2]);
                }
                // Parse True/False: 41-True, 42-False
                elseif (preg_match_all('/(\d+)-(True|False)/i', $line, $matches, PREG_SET_ORDER)) {
                    foreach ($matches as $match) {
                        $answerKeys['tf'][(int)$match[1]] = ucfirst(strtolower($match[2]));
                    }
                }
            }
        }

        // Second pass: Parse questions
        $inAnswerKey = false;
        foreach ($lines as $line) {
            // Skip empty lines
            if (empty($line) || $line === '---') {
                continue;
            }

            // Detect answer key section - stop parsing questions
            if (strpos($line, 'Answer Key') !== false || strpos($line, '✅') === 0) {
                // Save any pending question before entering answer key
                if ($currentQuestion) {
                    if ($questionType === 'identification' || !empty($currentAnswers)) {
                        $this->saveQuestion($quiz, $currentQuestion, $currentAnswers, $questionType, $questionNumber, $answerKeys);
                        $questionCount++;
                    }
                    $currentQuestion = null;
                    $currentAnswers = [];
                }
                $inAnswerKey = true;
                continue;
            }

            // Skip lines in answer key section
            if ($inAnswerKey) {
                continue;
            }

            // Detect section headers
            if (strpos($line, 'PART I') !== false || strpos($line, 'PART 1') !== false || 
                (stripos($line, 'Multiple Choice') !== false && preg_match('/\(\d+\s+items\)/i', $line))) {
                // Save previous question if exists
                if ($currentQuestion) {
                    if ($questionType === 'identification' || !empty($currentAnswers)) {
                        $this->saveQuestion($quiz, $currentQuestion, $currentAnswers, $questionType, $questionNumber, $answerKeys);
                        $questionCount++;
                    }
                    $currentQuestion = null;
                    $currentAnswers = [];
                }
                $questionType = 'multiple_choice';
                $questionNumber = 1;
                continue;
            }
            if (strpos($line, 'PART II') !== false || strpos($line, 'PART 2') !== false ||
                (stripos($line, 'Identification') !== false && preg_match('/\(\d+\s+items\)/i', $line))) {
                // Save previous question if exists
                if ($currentQuestion) {
                    if ($questionType === 'identification' || !empty($currentAnswers)) {
                        $this->saveQuestion($quiz, $currentQuestion, $currentAnswers, $questionType, $questionNumber, $answerKeys);
                        $questionCount++;
                    }
                    $currentQuestion = null;
                    $currentAnswers = [];
                }
                $questionType = 'identification';
                $questionNumber = 31;
                continue;
            }
            if (strpos($line, 'PART III') !== false || strpos($line, 'PART 3') !== false ||
                (preg_match('/True.*False.*\(\d+\s+items\)/i', $line))) {
                // Save previous question if exists
                if ($currentQuestion) {
                    if ($questionType === 'identification' || !empty($currentAnswers)) {
                        $this->saveQuestion($quiz, $currentQuestion, $currentAnswers, $questionType, $questionNumber, $answerKeys);
                        $questionCount++;
                    }
                    $currentQuestion = null;
                    $currentAnswers = [];
                }
                $questionType = 'true_false';
                $questionNumber = 41;
                continue;
            }

            // Skip instruction lines
            if (stripos($line, 'Instruction') !== false || 
                stripos($line, 'Write the') !== false || 
                stripos($line, 'Choose') !== false ||
                stripos($line, 'correct answer') !== false ||
                stripos($line, 'correct term') !== false ||
                preg_match('/^\d+\s+items/i', $line)) {
                continue;
            }

            // Check if line is an answer option (a), b), c), d))
            if (preg_match('/^[a-d]\)\s+(.+)$/i', $line, $matches)) {
                if ($questionType === 'multiple_choice') {
                    $currentAnswers[] = [
                        'letter' => strtolower(substr($line, 0, 1)),
                        'text' => $matches[1],
                    ];
                }
                continue;
            }

            // Check for True/False options (lines after identification questions)
            if (preg_match('/^(True|False)$/i', $line)) {
                if ($questionType === 'true_false') {
                    $currentAnswers[] = [
                        'text' => ucfirst(strtolower($line)), // Normalize to True/False
                    ];
                }
                continue;
            }

            // If we have a current question and this is a new question line
            if ($currentQuestion) {
                // For multiple choice, we need answers before saving
                if ($questionType === 'multiple_choice' && !empty($currentAnswers)) {
                    $this->saveQuestion($quiz, $currentQuestion, $currentAnswers, $questionType, $questionNumber, $answerKeys);
                    $questionCount++;
                    $questionNumber++;
                    $currentQuestion = null;
                    $currentAnswers = [];
                }
                // For identification, save immediately (no answer options needed)
                elseif ($questionType === 'identification') {
                    $this->saveQuestion($quiz, $currentQuestion, [], $questionType, $questionNumber, $answerKeys);
                    $questionCount++;
                    $questionNumber++;
                    $currentQuestion = null;
                    $currentAnswers = [];
                }
                // For true/false, save immediately
                elseif ($questionType === 'true_false') {
                    $this->saveQuestion($quiz, $currentQuestion, [], $questionType, $questionNumber, $answerKeys);
                    $questionCount++;
                    $questionNumber++;
                    $currentQuestion = null;
                    $currentAnswers = [];
                }
            }

            // This line is a new question
            if (!empty($line) && !preg_match('/^[a-d]\)/i', $line)) {
                $currentQuestion = $line;
            }
        }

        // Save the last question if exists
        if ($currentQuestion) {
            if ($questionType === 'identification' || $questionType === 'true_false' || !empty($currentAnswers)) {
                $this->saveQuestion($quiz, $currentQuestion, $currentAnswers, $questionType, $questionNumber, $answerKeys);
                $questionCount++;
            }
        }

        return $questionCount;
    }

    private function saveQuestion(Quiz $quiz, string $questionText, array $answers, string $type, int $number, array $answerKeys)
    {
        $question = Question::create([
            'quiz_id' => $quiz->id,
            'question_text' => $questionText,
            'question_type' => $type,
            'question_number' => $number,
        ]);

        if ($type === 'multiple_choice') {
            $correctAnswer = $answerKeys['mc'][$number] ?? 'a';
            foreach ($answers as $answer) {
                Answer::create([
                    'question_id' => $question->id,
                    'answer_text' => $answer['text'],
                    'answer_letter' => $answer['letter'],
                    'is_correct' => $answer['letter'] === $correctAnswer,
                ]);
            }
        } elseif ($type === 'identification') {
            // For identification, get answer from the answer key
            $correctAnswer = $answerKeys['id'][$number] ?? 'Unknown';
            Answer::create([
                'question_id' => $question->id,
                'answer_text' => $correctAnswer,
                'is_correct' => true,
            ]);
        } elseif ($type === 'true_false') {
            // Create both True and False options
            $correctAnswer = $answerKeys['tf'][$number] ?? 'False';
            
            Answer::create([
                'question_id' => $question->id,
                'answer_text' => 'True',
                'is_correct' => $correctAnswer === 'True',
            ]);
            
            Answer::create([
                'question_id' => $question->id,
                'answer_text' => 'False',
                'is_correct' => $correctAnswer === 'False',
            ]);
        }
    }

    // Quiz Taking Methods
    public function take($id)
    {
        $quiz = Quiz::with('questions.answers')->findOrFail($id);
        return view('quiz.take', ['quiz' => $quiz]);
    }

    public function submit(Request $request, $id)
    {
        $quiz = Quiz::with('questions.answers')->findOrFail($id);
        
        // Create attempt record
        $attempt = Attempt::create([
            'user_id' => auth()->id() ?? 1, // Default to user 1 if not authenticated
            'quiz_id' => $quiz->id,
            'total_questions' => $quiz->total_questions,
        ]);

        $score = 0;
        $answers = [];

        // Process each question
        foreach ($quiz->questions as $question) {
            $userAnswer = $request->input("question_{$question->id}");
            $answers[$question->id] = $userAnswer;

            if ($question->question_type === 'multiple_choice' || $question->question_type === 'true_false') {
                // Find the selected answer
                $selectedAnswer = Answer::find($userAnswer);
                
                if ($selectedAnswer && $selectedAnswer->is_correct) {
                    $score++;
                    $isCorrect = true;
                } else {
                    $isCorrect = false;
                }

                // Store response
                Response::create([
                    'attempt_id' => $attempt->id,
                    'question_id' => $question->id,
                    'answer_id' => $userAnswer,
                    'is_correct' => $isCorrect,
                ]);
            } elseif ($question->question_type === 'identification') {
                // For identification, compare user answer with correct answer (case-insensitive)
                $correctAnswer = $question->answers->first(fn($a) => $a->is_correct);
                $isCorrect = false;

                if ($correctAnswer && $userAnswer) {
                    // Simple match (can be enhanced with fuzzy matching)
                    $isCorrect = strtolower(trim($userAnswer)) === strtolower(trim($correctAnswer->answer_text));
                    if ($isCorrect) {
                        $score++;
                    }
                }

                // Store response
                Response::create([
                    'attempt_id' => $attempt->id,
                    'question_id' => $question->id,
                    'user_answer' => $userAnswer,
                    'is_correct' => $isCorrect,
                ]);
            }
        }

        // Update attempt with final score
        $attempt->update([
            'score' => $score,
            'answers' => $answers,
        ]);

        return redirect()->route('quiz.results', ['quiz' => $quiz->id, 'attempt' => $attempt->id])
            ->with('success', "Quiz completed! You scored {$score}/{$quiz->total_questions}");
    }

    public function results($quizId, $attemptId)
    {
        $quiz = Quiz::with('questions.answers')->findOrFail($quizId);
        $attempt = Attempt::with('responses.question.answers', 'responses.answer')->findOrFail($attemptId);

        // Calculate percentage
        $percentage = $quiz->total_questions > 0 
            ? round(($attempt->score / $quiz->total_questions) * 100, 2)
            : 0;

        return view('quiz.results', [
            'quiz' => $quiz,
            'attempt' => $attempt,
            'percentage' => $percentage,
        ]);
    }

    public function update(Request $request, $id)
    {
        $quiz = Quiz::findOrFail($id);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $quiz->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('quiz.show', $quiz->id)
            ->with('success', 'Quiz updated successfully!');
    }

    public function history()
    {
        // Get all attempts ordered by most recent
        $attempts = Attempt::with('quiz', 'user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('quiz.history', ['attempts' => $attempts]);
    }

    public function userAttempts($userId)
    {
        $user = \App\Models\User::findOrFail($userId);
        $attempts = $user->attempts()
            ->with('quiz')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('quiz.user-attempts', [
            'user' => $user,
            'attempts' => $attempts,
        ]);
    }

    // Question Management Methods
    public function addQuestion(Request $request, $quizId)
    {
        $quiz = Quiz::findOrFail($quizId);
        
        $request->validate([
            'question_text' => 'required|string',
            'question_type' => 'required|in:multiple_choice,identification,true_false',
            'answers' => 'required|array',
            'answers.*.text' => 'required|string',
            'correct_answer' => 'required',
        ]);

        $nextNumber = $quiz->questions()->max('question_number') + 1;

        $question = Question::create([
            'quiz_id' => $quiz->id,
            'question_text' => $request->question_text,
            'question_type' => $request->question_type,
            'question_number' => $nextNumber,
        ]);

        // Create answers
        if ($request->question_type === 'multiple_choice') {
            foreach ($request->answers as $index => $answer) {
                Answer::create([
                    'question_id' => $question->id,
                    'answer_text' => $answer['text'],
                    'answer_letter' => chr(97 + $index),
                    'is_correct' => (string)$index === $request->correct_answer,
                ]);
            }
        } elseif ($request->question_type === 'identification') {
            Answer::create([
                'question_id' => $question->id,
                'answer_text' => $request->correct_answer,
                'is_correct' => true,
            ]);
        } elseif ($request->question_type === 'true_false') {
            Answer::create([
                'question_id' => $question->id,
                'answer_text' => 'True',
                'is_correct' => $request->correct_answer === 'true',
            ]);
            Answer::create([
                'question_id' => $question->id,
                'answer_text' => 'False',
                'is_correct' => $request->correct_answer === 'false',
            ]);
        }

        $quiz->update(['total_questions' => $quiz->total_questions + 1]);

        return redirect()->route('quiz.edit', $quiz->id)
            ->with('success', 'Question added successfully!');
    }

    public function updateQuestion(Request $request, $quizId, $questionId)
    {
        $quiz = Quiz::findOrFail($quizId);
        $question = Question::findOrFail($questionId);

        $request->validate([
            'question_text' => 'required|string',
            'answers' => 'required|array',
            'answers.*.text' => 'required|string',
            'correct_answer' => 'required',
        ]);

        $question->update([
            'question_text' => $request->question_text,
        ]);

        // Delete old answers
        $question->answers()->delete();

        // Create new answers
        if ($question->question_type === 'multiple_choice') {
            foreach ($request->answers as $index => $answer) {
                Answer::create([
                    'question_id' => $question->id,
                    'answer_text' => $answer['text'],
                    'answer_letter' => chr(97 + $index),
                    'is_correct' => (string)$index === $request->correct_answer,
                ]);
            }
        } elseif ($question->question_type === 'identification') {
            Answer::create([
                'question_id' => $question->id,
                'answer_text' => $request->correct_answer,
                'is_correct' => true,
            ]);
        } elseif ($question->question_type === 'true_false') {
            Answer::create([
                'question_id' => $question->id,
                'answer_text' => 'True',
                'is_correct' => $request->correct_answer === 'true',
            ]);
            Answer::create([
                'question_id' => $question->id,
                'answer_text' => 'False',
                'is_correct' => $request->correct_answer === 'false',
            ]);
        }

        return redirect()->route('quiz.edit', $quiz->id)
            ->with('success', 'Question updated successfully!');
    }

    public function deleteQuestion($quizId, $questionId)
    {
        $quiz = Quiz::findOrFail($quizId);
        $question = Question::findOrFail($questionId);

        $question->answers()->delete();
        $question->delete();

        // Update total questions
        $quiz->update(['total_questions' => $quiz->total_questions - 1]);

        // Reorder question numbers
        $questions = $quiz->questions()->orderBy('question_number')->get();
        foreach ($questions as $index => $q) {
            $q->update(['question_number' => $index + 1]);
        }

        return redirect()->route('quiz.edit', $quiz->id)
            ->with('success', 'Question deleted successfully!');
    }

    // Remove the hardcoded answer key methods
    // private function getCorrectAnswer() - No longer needed
    // private function getIdentificationAnswer() - No longer needed
    // private function getTrueFalseAnswer() - No longer needed
}
