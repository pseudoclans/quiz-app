<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuizController extends Controller
{
    public function index()
    {
        $quizData = $this->getQuizData();
        return view('quiz.index', ['quizzes' => $quizData['quizzes']]);
    }

    public function show($id)
    {
        $quizData = $this->getQuizData();
        $quiz = collect($quizData['quizzes'])->firstWhere('id', (int)$id);
        
        if (!$quiz) {
            abort(404);
        }

        return view('quiz.show', ['quiz' => $quiz]);
    }

    public function submit(Request $request, $id)
    {
        $quizData = $this->getQuizData();
        $quiz = collect($quizData['quizzes'])->firstWhere('id', (int)$id);
        
        if (!$quiz) {
            abort(404);
        }

        $results = [];
        $totalQuestions = 0;
        $correctAnswers = 0;

        foreach ($quiz['sets'] as $set) {
            foreach ($set['questions'] as $question) {
                $totalQuestions++;
                $questionId = $question['id'];
                $userAnswer = $request->input("question_{$questionId}");
                $correctAnswer = $question['correct_answer'];
                
                $isCorrect = strcasecmp(trim($userAnswer), trim($correctAnswer)) === 0;
                
                if ($isCorrect) {
                    $correctAnswers++;
                }

                $results[] = [
                    'question' => $question['question'],
                    'user_answer' => $userAnswer,
                    'correct_answer' => $correctAnswer,
                    'is_correct' => $isCorrect,
                    'type' => $set['type']
                ];
            }
        }

        $score = ($correctAnswers / $totalQuestions) * 100;

        return view('quiz.results', [
            'quiz' => $quiz,
            'results' => $results,
            'score' => round($score, 2),
            'correct' => $correctAnswers,
            'total' => $totalQuestions
        ]);
    }

    public function create()
    {
        return view('quiz.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'sets' => 'required|array|min:1',
            'sets.*.type' => 'required|in:multiple_choice,identification',
            'sets.*.questions' => 'required|array|min:1',
        ]);

        $quizData = $this->getQuizData();
        
        // Generate new quiz ID
        $newId = count($quizData['quizzes']) > 0 
            ? max(array_column($quizData['quizzes'], 'id')) + 1 
            : 1;

        // Generate question IDs
        $questionId = $this->getMaxQuestionId($quizData) + 1;
        
        $sets = [];
        foreach ($request->sets as $index => $set) {
            $questions = [];
            foreach ($set['questions'] as $question) {
                $questionData = [
                    'id' => $questionId++,
                    'question' => $question['question'],
                    'correct_answer' => $question['correct_answer']
                ];
                
                if ($set['type'] === 'multiple_choice') {
                    $questionData['choices'] = $question['choices'];
                }
                
                $questions[] = $questionData;
            }
            
            $sets[] = [
                'set_number' => $index + 1,
                'type' => $set['type'],
                'questions' => $questions
            ];
        }

        $newQuiz = [
            'id' => $newId,
            'title' => $request->title,
            'sets' => $sets
        ];

        $quizData['quizzes'][] = $newQuiz;
        $this->saveQuizData($quizData);

        return redirect()->route('quiz.index')->with('success', 'Quiz created successfully!');
    }

    public function edit($id)
    {
        $quizData = $this->getQuizData();
        $quiz = collect($quizData['quizzes'])->firstWhere('id', (int)$id);
        
        if (!$quiz) {
            abort(404);
        }

        return view('quiz.edit', ['quiz' => $quiz]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'sets' => 'required|array|min:1',
        ]);

        $quizData = $this->getQuizData();
        $quizIndex = collect($quizData['quizzes'])->search(fn($q) => $q['id'] == (int)$id);
        
        if ($quizIndex === false) {
            abort(404);
        }

        $questionId = $this->getMaxQuestionId($quizData) + 1;
        
        $sets = [];
        foreach ($request->sets as $index => $set) {
            $questions = [];
            foreach ($set['questions'] as $question) {
                $questionData = [
                    'id' => $question['id'] ?? $questionId++,
                    'question' => $question['question'],
                    'correct_answer' => $question['correct_answer']
                ];
                
                if ($set['type'] === 'multiple_choice') {
                    $questionData['choices'] = $question['choices'];
                }
                
                $questions[] = $questionData;
            }
            
            $sets[] = [
                'set_number' => $index + 1,
                'type' => $set['type'],
                'questions' => $questions
            ];
        }

        $quizData['quizzes'][$quizIndex]['title'] = $request->title;
        $quizData['quizzes'][$quizIndex]['sets'] = $sets;
        
        $this->saveQuizData($quizData);

        return redirect()->route('quiz.index')->with('success', 'Quiz updated successfully!');
    }

    public function destroy($id)
    {
        $quizData = $this->getQuizData();
        $quizData['quizzes'] = array_values(
            array_filter($quizData['quizzes'], fn($q) => $q['id'] != (int)$id)
        );
        
        $this->saveQuizData($quizData);

        return redirect()->route('quiz.index')->with('success', 'Quiz deleted successfully!');
    }

    private function getQuizData()
    {
        if (!Storage::exists('quizzes.json')) {
            return ['quizzes' => []];
        }
        
        $json = Storage::get('quizzes.json');
        $data = json_decode($json, true);
        
        if (!$data || !isset($data['quizzes'])) {
            return ['quizzes' => []];
        }
        
        return $data;
    }

    private function saveQuizData($data)
    {
        Storage::put('quizzes.json', json_encode($data, JSON_PRETTY_PRINT));
    }

    private function getMaxQuestionId($quizData)
    {
        $maxId = 0;
        foreach ($quizData['quizzes'] as $quiz) {
            foreach ($quiz['sets'] as $set) {
                foreach ($set['questions'] as $question) {
                    if ($question['id'] > $maxId) {
                        $maxId = $question['id'];
                    }
                }
            }
        }
        return $maxId;
    }
}
