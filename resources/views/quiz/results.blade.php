<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Results · QuizApp</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .result-header {
            text-align: center;
            padding: 2rem;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 1rem;
            margin-bottom: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .score-display {
            display: flex;
            justify-content: center;
            align-items: flex-end;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .score-big {
            font-size: 4rem;
            font-weight: 700;
            background: linear-gradient(135deg, #3b82f6, #06b6d4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .score-total {
            font-size: 1.5rem;
            color: rgba(255, 255, 255, 0.6);
            font-weight: 600;
        }

        .percentage-circle {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2.5rem;
            font-weight: 700;
            background: conic-gradient(
                from 0deg,
                rgb(59, 130, 246) 0%,
                rgb(59, 130, 246) {{ $percentage }}%,
                rgba(255, 255, 255, 0.1) {{ $percentage }}%
            );
            position: relative;
        }

        .percentage-circle::before {
            content: '{{ round($percentage) }}%';
            position: absolute;
            width: 110px;
            height: 110px;
            border-radius: 50%;
            background: linear-gradient(135deg, #1f2937, #111827);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
        }

        .result-status {
            display: inline-block;
            padding: 0.5rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }

        .result-pass {
            background: rgba(16, 185, 129, 0.2);
            color: #10b981;
        }

        .result-fail {
            background: rgba(239, 68, 68, 0.2);
            color: #f87171;
        }

        .result-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 0.5rem;
            padding: 1rem;
            text-align: center;
        }

        .stat-label {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 600;
            color: #3b82f6;
        }

        .review-section {
            margin-top: 3rem;
        }

        .review-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
        }

        .section-divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin: 2rem 0 1rem 0;
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
        }

        .question-review {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 0.5rem;
            padding: 1.25rem;
            margin-bottom: 1.5rem;
        }

        .question-review.correct {
            border-left: 4px solid #10b981;
        }

        .question-review.incorrect {
            border-left: 4px solid #ef4444;
        }

        .review-question-number {
            display: inline-block;
            background: rgba(59, 130, 246, 0.2);
            color: #3b82f6;
            padding: 0.25rem 0.75rem;
            border-radius: 0.25rem;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
        }

        .review-question-text {
            font-weight: 600;
            margin-bottom: 1rem;
            font-size: 1rem;
        }

        .review-answer-row {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
            padding: 0.75rem;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 0.25rem;
        }

        .review-answer-label {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.9rem;
            min-width: 100px;
        }

        .review-answer-text {
            flex: 1;
        }

        .answer-mark {
            display: inline-block;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .answer-correct {
            color: #10b981;
        }

        .answer-incorrect {
            color: #ef4444;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 0.75rem 2rem;
            border-radius: 0.5rem;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3b82f6, #06b6d4);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(59, 130, 246, 0.3);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
<body class="page">
    <div class="mesh-bg"></div>
    <div class="mesh-glow"></div>

    <header class="topbar glass">
        <div class="topbar-inner">
            <a href="{{ route('quiz.index') }}" class="btn btn-ghost">← Back to Dashboard</a>
            <div class="page-title" style="font-size: 1.2rem;">Quiz Results</div>
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
        <div class="result-header" data-reveal data-delay="80">
            <div class="percentage-circle"></div>
            
            @php
                $isPassing = $percentage >= 70;
            @endphp
            
            <div class="result-status {{ $isPassing ? 'result-pass' : 'result-fail' }}">
                {{ $isPassing ? '✓ PASSED' : '✗ NEEDS IMPROVEMENT' }}
            </div>

            <div class="page-title" style="margin-bottom: 0.5rem;">{{ $quiz->title }}</div>
            <div class="page-subtitle">Quiz completed successfully</div>

            <div class="result-stats">
                <div class="stat-card">
                    <div class="stat-label">Correct Answers</div>
                    <div class="stat-value">{{ $attempt->score }}/{{ $quiz->total_questions }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Percentage</div>
                    <div class="stat-value">{{ round($percentage) }}%</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Completion Time</div>
                    <div class="stat-value">
                        @php
                            $duration = $attempt->created_at->diffInMinutes(now());
                        @endphp
                        {{ $duration }} min
                    </div>
                </div>
            </div>
        </div>

        <div class="review-section" data-reveal data-delay="140">
            <div class="review-title">Detailed Review</div>

            @php
                $currentType = null;
                $typeCounter = 0;
            @endphp

            @foreach($attempt->responses as $response)
                @php
                    $question = $response->question;
                    if ($question->question_type !== $currentType) {
                        $currentType = $question->question_type;
                        $typeCounter++;
                        $typeName = match($currentType) {
                            'multiple_choice' => 'Part I - Multiple Choice',
                            'identification' => 'Part II - Identification',
                            'true_false' => 'Part III - True or False',
                            default => 'Questions'
                        };
                    }
                @endphp

                @if($typeCounter == 1 || $question->question_type !== $currentType)
                    <div class="section-divider">
                        <div class="section-title">{{ $typeName }}</div>
                    </div>
                @endif

                <div class="question-review {{ $response->is_correct ? 'correct' : 'incorrect' }}">
                    <div class="review-question-number">Question {{ $question->question_number }}</div>
                    <div class="review-question-text">{{ $question->question_text }}</div>

                    @if($question->question_type === 'multiple_choice')
                        <div class="review-answer-row">
                            <span class="review-answer-label">Your Answer:</span>
                            <span class="review-answer-text">
                                @if($response->answer)
                                    {{ strtoupper($response->answer->answer_letter) }}) {{ $response->answer->answer_text }}
                                    <span class="answer-mark {{ $response->is_correct ? 'answer-correct' : 'answer-incorrect' }}">
                                        {{ $response->is_correct ? '✓' : '✗' }}
                                    </span>
                                @endif
                            </span>
                        </div>
                        @if(!$response->is_correct)
                            <div class="review-answer-row">
                                <span class="review-answer-label">Correct Answer:</span>
                                <span class="review-answer-text">
                                    @php
                                        $correctAnswer = $question->answers->firstWhere('is_correct', true);
                                    @endphp
                                    {{ strtoupper($correctAnswer->answer_letter) }}) {{ $correctAnswer->answer_text }}
                                    <span class="answer-mark answer-correct">✓</span>
                                </span>
                            </div>
                        @endif
                    @elseif($question->question_type === 'identification')
                        <div class="review-answer-row">
                            <span class="review-answer-label">Your Answer:</span>
                            <span class="review-answer-text">
                                {{ $response->user_answer }}
                                <span class="answer-mark {{ $response->is_correct ? 'answer-correct' : 'answer-incorrect' }}">
                                    {{ $response->is_correct ? '✓' : '✗' }}
                                </span>
                            </span>
                        </div>
                        @if(!$response->is_correct)
                            <div class="review-answer-row">
                                <span class="review-answer-label">Correct Answer:</span>
                                <span class="review-answer-text">
                                    @php
                                        $correctAnswer = $question->answers->firstWhere('is_correct', true);
                                    @endphp
                                    {{ $correctAnswer->answer_text }}
                                    <span class="answer-mark answer-correct">✓</span>
                                </span>
                            </div>
                        @endif
                    @elseif($question->question_type === 'true_false')
                        <div class="review-answer-row">
                            <span class="review-answer-label">Your Answer:</span>
                            <span class="review-answer-text">
                                @if($response->answer)
                                    {{ $response->answer->answer_text }}
                                    <span class="answer-mark {{ $response->is_correct ? 'answer-correct' : 'answer-incorrect' }}">
                                        {{ $response->is_correct ? '✓' : '✗' }}
                                    </span>
                                @endif
                            </span>
                        </div>
                        @if(!$response->is_correct)
                            <div class="review-answer-row">
                                <span class="review-answer-label">Correct Answer:</span>
                                <span class="review-answer-text">
                                    @php
                                        $correctAnswer = $question->answers->firstWhere('is_correct', true);
                                    @endphp
                                    {{ $correctAnswer->answer_text }}
                                    <span class="answer-mark answer-correct">✓</span>
                                </span>
                            </div>
                        @endif
                    @endif
                </div>
            @endforeach
        </div>

        <div class="action-buttons">
            <a href="{{ route('quiz.take', $quiz->id) }}" class="btn btn-primary">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 12a9 9 0 010-18 9 9 0 010 18zM12 7v5l3 2" />
                </svg>
                Retake Quiz
            </a>
            <a href="{{ route('quiz.show', $quiz->id) }}" class="btn btn-secondary">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M15 19l-7-7 7-7" />
                </svg>
                View Quiz
            </a>
            <a href="{{ route('quiz.index') }}" class="btn btn-secondary">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Back to Dashboard
            </a>
        </div>
    </main>

    @vite(['resources/js/app.js'])
</body>
</html>

