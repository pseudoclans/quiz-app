<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Results</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="navbar">
        <div class="navbar-content">
            <a href="{{ route('quiz.index') }}" class="navbar-brand">🎯 QuizMaster</a>
            <div class="navbar-nav">
                <a href="{{ route('quiz.index') }}" class="nav-link">← Back to Quizzes</a>
            </div>
        </div>
    </div>

    <div class="container-narrow">
        <div class="card fade-in">
            <h1 style="color: var(--dark); text-shadow: none;">Quiz Results: {{ $quiz['title'] }}</h1>
            
            <div class="score-card">
                <h2>{{ $score }}%</h2>
                <p>You got {{ $correct }} out of {{ $total }} questions correct!</p>
            </div>
            
            <div class="results-list">
                @foreach($results as $result)
                    <div class="result-item {{ $result['is_correct'] ? 'correct' : 'incorrect' }}">
                        <p class="question">{{ $result['question'] }}</p>
                        <p class="answer">Your Answer: <strong>{{ $result['user_answer'] ?: 'No answer' }}</strong></p>
                        @if(!$result['is_correct'])
                            <p class="correct-answer">Correct Answer: <strong>{{ $result['correct_answer'] }}</strong></p>
                        @endif
                        <span class="badge">{{ $result['is_correct'] ? '✓ Correct' : '✗ Incorrect' }}</span>
                    </div>
                @endforeach
            </div>
            
            <div class="actions">
                <a href="{{ route('quiz.index') }}" class="btn btn-secondary">Back to Quizzes</a>
                <a href="{{ route('quiz.show', $quiz['id']) }}" class="btn btn-primary">Retake Quiz</a>
            </div>
        </div>
    </div>
</body>
</html>
