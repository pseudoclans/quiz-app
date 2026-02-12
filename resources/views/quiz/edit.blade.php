<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Quiz</title>
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
            <h1 style="color: var(--dark); text-shadow: none;">✏️ Edit Quiz</h1>
            
            <form method="POST" action="{{ route('quiz.update', $quiz['id']) }}">
                @csrf
                
                <div class="form-group">
                    <label for="title">Quiz Title</label>
                    <input type="text" id="title" name="title" class="text-input" value="{{ $quiz['title'] }}" required>
                </div>

                @foreach($quiz['sets'] as $setIndex => $set)
                    <div class="quiz-set">
                        <span class="set-badge">Set {{ $set['set_number'] }}: {{ ucfirst(str_replace('_', ' ', $set['type'])) }}</span>
                        
                        <input type="hidden" name="sets[{{ $setIndex }}][type]" value="{{ $set['type'] }}">
                        
                        @foreach($set['questions'] as $qIndex => $question)
                            <div class="question-block">
                                <label>❓ Question {{ $qIndex + 1 }}</label>
                                <input type="hidden" name="sets[{{ $setIndex }}][questions][{{ $qIndex }}][id]" value="{{ $question['id'] }}">
                                <input type="text" name="sets[{{ $setIndex }}][questions][{{ $qIndex }}][question]" 
                                       class="text-input" value="{{ $question['question'] }}" required>
                                
                                @if($set['type'] === 'multiple_choice')
                                    <label>Choices</label>
                                    @foreach($question['choices'] as $cIndex => $choice)
                                        <input type="text" name="sets[{{ $setIndex }}][questions][{{ $qIndex }}][choices][]" 
                                               class="text-input" value="{{ $choice }}" required>
                                    @endforeach
                                @endif

                                <label>Correct Answer</label>
                                <input type="text" name="sets[{{ $setIndex }}][questions][{{ $qIndex }}][correct_answer]" 
                                       class="text-input" value="{{ $question['correct_answer'] }}" required>
                            </div>
                        @endforeach
                    </div>
                @endforeach

                <div class="actions">
                    <a href="{{ route('quiz.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-submit">Update Quiz 🚀</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
