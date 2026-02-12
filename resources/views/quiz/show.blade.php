<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $quiz['title'] }}</title>
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
            <h1 style="color: var(--dark); text-shadow: none;">{{ $quiz['title'] }}</h1>
            
            <form method="POST" action="{{ route('quiz.submit', $quiz['id']) }}">
                @csrf
                
                @foreach($quiz['sets'] as $set)
                    <div class="quiz-set">
                        <span class="set-badge">Set {{ $set['set_number'] }}: {{ ucfirst(str_replace('_', ' ', $set['type'])) }}</span>
                        
                        @foreach($set['questions'] as $question)
                            <div class="question-block">
                                <p class="question">{{ $loop->parent->iteration }}.{{ $loop->iteration }}. {{ $question['question'] }}</p>
                                
                                @if($set['type'] === 'multiple_choice')
                                    <div class="choices">
                                        @foreach($question['choices'] as $choice)
                                            <label class="choice-label">
                                                <input type="radio" 
                                                       name="question_{{ $question['id'] }}" 
                                                       value="{{ $choice }}" 
                                                       required>
                                                <span>{{ $choice }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                @else
                                    <input type="text" 
                                           name="question_{{ $question['id'] }}" 
                                           class="text-input" 
                                           placeholder="Type your answer here"
                                           required>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endforeach
                
                <button type="submit" class="btn btn-submit">Submit Quiz 🚀</button>
            </form>
        </div>
    </div>
</body>
</html>
