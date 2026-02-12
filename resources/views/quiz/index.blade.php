<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Application</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="navbar">
        <div class="navbar-content">
            <a href="{{ route('quiz.index') }}" class="navbar-brand">🎯 QuizMaster</a>
            <div class="navbar-nav">
                <a href="{{ route('quiz.index') }}" class="nav-link">Home</a>
                <a href="{{ route('quiz.create') }}" class="btn btn-primary">+ Create Quiz</a>
            </div>
        </div>
    </div>

    <div class="container">
        <h1>📚 Available Quizzes</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(count($quizzes) === 0)
            <div class="empty-state fade-in">
                <div class="empty-state-icon">📝</div>
                <p>No quizzes available yet. Start creating your first quiz!</p>
                <a href="{{ route('quiz.create') }}" class="btn btn-primary">Create Your First Quiz</a>
            </div>
        @else
            <div class="quiz-list">
                @foreach($quizzes as $quiz)
                    <div class="quiz-card fade-in">
                        <h2>{{ $quiz['title'] }}</h2>
                        <div class="quiz-meta">
                            <div class="quiz-meta-item">
                                <span>📑</span>
                                <span><strong>{{ count($quiz['sets']) }}</strong> Sets</span>
                            </div>
                            <div class="quiz-meta-item">
                                <span>❓</span>
                                <span><strong>{{ collect($quiz['sets'])->sum(fn($set) => count($set['questions'])) }}</strong> Questions</span>
                            </div>
                        </div>
                        <div class="card-actions">
                            <a href="{{ route('quiz.show', $quiz['id']) }}" class="btn">Start Quiz</a>
                            <a href="{{ route('quiz.edit', $quiz['id']) }}" class="btn btn-secondary">Edit</a>
                            <form method="POST" action="{{ route('quiz.destroy', $quiz['id']) }}" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this quiz?')">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>
