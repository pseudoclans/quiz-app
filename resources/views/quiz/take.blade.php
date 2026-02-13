<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Take Quiz: {{ $quiz->title }} · QuizApp</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .question-section {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 0.75rem;
            padding: 1.5rem;
            margin-bottom: 2rem;
            backdrop-filter: blur(10px);
        }

        .question-number {
            display: inline-block;
            background: rgba(59, 130, 246, 0.2);
            color: #3b82f6;
            padding: 0.25rem 0.75rem;
            border-radius: 0.25rem;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
        }

        .question-text {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1.25rem;
            line-height: 1.6;
        }

        .answer-option {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 0.5rem;
            padding: 1rem;
            margin-bottom: 0.75rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .answer-option:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .answer-option input[type="radio"],
        .answer-option input[type="text"] {
            margin: 0;
        }

        .answer-option input[type="radio"]:checked + span {
            color: #3b82f6;
            font-weight: 600;
        }

        .answer-option input[type="radio"]:checked {
            accent-color: #3b82f6;
        }

        .identification-input {
            width: 100%;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 0.5rem;
            padding: 0.75rem;
            color: white;
            font-size: 1rem;
        }

        .identification-input::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        .identification-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .section-divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin: 2rem 0;
        }

        .section-divider::before,
        .section-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(255, 255, 255, 0.1);
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #3b82f6;
            text-align: center;
            padding: 1rem 0;
        }

        .progress-bar {
            height: 4px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 2px;
            margin-bottom: 1.5rem;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #3b82f6, #06b6d4);
            width: 0%;
            transition: width 0.3s ease;
        }

        .btn-submit {
            background: linear-gradient(135deg, #3b82f6, #06b6d4);
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 1rem;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(59, 130, 246, 0.3);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .unanswered-warning {
            background: rgba(239, 68, 68, 0.1);
            border-left: 3px solid #ef4444;
            padding: 0.75rem 1rem;
            border-radius: 0.25rem;
            margin-top: 1rem;
            color: #fca5a5;
            font-size: 0.9rem;
        }
    </style>
</head>
<body class="page">
    <div class="mesh-bg"></div>
    <div class="mesh-glow"></div>

    <header class="topbar glass">
        <div class="topbar-inner">
            <a href="{{ route('quiz.index') }}" class="btn btn-ghost">← Back to Dashboard</a>
            <div class="page-title" style="font-size: 1.2rem;">{{ $quiz->title }}</div>
            <div class="topbar-actions">
                <button class="icon-btn" id="themeToggle" aria-pressed="false">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 3a9 9 0 100 18 9 9 0 000-18z" />
                    </svg>
                </button>
                <span class="faint" id="themeLabel">Dark</span>
            </div>
        </div>
    </header>

    <main class="main" style="max-width: 900px; margin: 0 auto;">
        <div class="page-header" data-reveal data-delay="80">
            <div>
                <div class="page-title">{{ $quiz->title }}</div>
                <div class="page-subtitle">Answer all questions to complete this quiz</div>
            </div>
            <span class="badge">{{ $quiz->total_questions }} Questions</span>
        </div>

        <div class="progress-bar">
            <div class="progress-fill" id="progressFill"></div>
        </div>

        <form method="POST" action="{{ route('quiz.submit', $quiz->id) }}" id="quizForm" data-reveal data-delay="140">
            @csrf
            @php
                $currentType = null;
                $typeCounter = 0;
                $currentQuestionIndex = 0;
            @endphp

            @foreach($quiz->questions as $question)
                @php $currentQuestionIndex++ @endphp

                @if($question->question_type !== $currentType)
                    @if($currentType !== null)
                        </section>
                    @endif
                    @php
                        $currentType = $question->question_type;
                        $typeCounter++;
                        $typeName = match($currentType) {
                            'multiple_choice' => 'Part I - Multiple Choice',
                            'identification' => 'Part II - Identification',
                            'true_false' => 'Part III - True or False',
                            default => 'Questions'
                        };
                    @endphp
                    <div class="section-divider">
                        <div class="section-title">{{ $typeName }}</div>
                    </div>
                    <section>
                @endif

                <div class="question-section">
                    <div class="question-number">Question {{ $question->question_number }}</div>
                    <div class="question-text">{{ $question->question_text }}</div>

                    @if($question->question_type === 'multiple_choice')
                        <div>
                            @foreach($question->answers as $answer)
                                <label class="answer-option">
                                    <input type="radio" name="question_{{ $question->id }}" value="{{ $answer->id }}" required>
                                    <span>{{ strtoupper($answer->answer_letter) }}) {{ $answer->answer_text }}</span>
                                </label>
                            @endforeach
                        </div>
                    @elseif($question->question_type === 'identification')
                        <div>
                            <input 
                                type="text" 
                                name="question_{{ $question->id }}" 
                                class="identification-input"
                                placeholder="Type your answer here..."
                                required
                            >
                        </div>
                    @elseif($question->question_type === 'true_false')
                        <div>
                            @foreach($question->answers as $answer)
                                <label class="answer-option">
                                    <input type="radio" name="question_{{ $question->id }}" value="{{ $answer->id }}" required>
                                    <span>{{ $answer->answer_text }}</span>
                                </label>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach

            </section>

            <div style="margin-top: 2rem; padding: 1.5rem; background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 0.75rem;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                    <div>
                        <div style="font-weight: 600;">Ready to submit?</div>
                        <div class="faint">You will see your results after submission</div>
                    </div>
                    <span class="status-pill">{{ $quiz->total_questions }} questions</span>
                </div>
                <button type="submit" class="btn-submit">Submit Quiz</button>
            </div>
        </form>
    </main>

    <script>
        // Update progress bar
        function updateProgress() {
            const form = document.getElementById('quizForm');
            const inputs = form.querySelectorAll('input[type="radio"], input[type="text"]');
            const answered = Array.from(inputs).filter(input => {
                if (input.type === 'radio') {
                    return input.checked;
                } else if (input.type === 'text') {
                    return input.value.trim() !== '';
                }
                return false;
            }).length;

            const totalQuestions = {{ $quiz->total_questions }};
            const percentage = (answered / totalQuestions) * 100;
            document.getElementById('progressFill').style.width = percentage + '%';
        }

        // Listen for changes
        const form = document.getElementById('quizForm');
        form.addEventListener('change', updateProgress);
        form.addEventListener('input', updateProgress);

        // Initial progress
        updateProgress();

        // Scroll to first unanswered question on submission attempt
        form.addEventListener('submit', function(e) {
            const inputs = form.querySelectorAll('input[type="radio"], input[type="text"]');
            
            for (let input of inputs) {
                if (input.type === 'radio') {
                    const name = input.name;
                    const checked = document.querySelector(`input[name="${name}"]:checked`);
                    if (!checked) {
                        e.preventDefault();
                        input.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        break;
                    }
                } else if (input.type === 'text') {
                    if (input.value.trim() === '') {
                        e.preventDefault();
                        input.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        input.focus();
                        break;
                    }
                }
            }
        });
    </script>

    @vite(['resources/js/app.js'])
</body>
</html>
