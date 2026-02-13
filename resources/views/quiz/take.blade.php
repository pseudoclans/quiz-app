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

    <!-- Mobile Overlay -->
    <div class="mobile-overlay" id="mobileOverlay"></div>

    <!-- Mobile Sidebar -->
    <aside class="sidebar glass" id="mobileSidebar" style="display: none;">
        <button class="mobile-close-btn" id="mobileCloseBtn" aria-label="Close menu">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M18 6L6 18M6 6l12 12" />
            </svg>
        </button>
        <div class="brand">
            <div class="brand-icon">Q</div>
            <span>QuizApp</span>
        </div>
        <nav class="nav-group">
            <a href="{{ route('quiz.index') }}" class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Dashboard
            </a>
            <a href="{{ route('quiz.create') }}" class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 4v16m8-8H4" />
                </svg>
                Create Quiz
            </a>
            <a href="{{ route('quiz.history') }}" class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 17v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6m8 0V7a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14" />
                </svg>
                History
            </a>
        </nav>
    </aside>

    <header class="topbar glass">
        <div class="topbar-inner">
            <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="Toggle menu">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 12h18M3 6h18M3 18h18" />
                </svg>
            </button>
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
        // Mobile menu functionality
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileCloseBtn = document.getElementById('mobileCloseBtn');
        const mobileSidebar = document.getElementById('mobileSidebar');
        const mobileOverlay = document.getElementById('mobileOverlay');

        if (mobileMenuBtn && mobileSidebar) {
            // Show sidebar on mobile
            if (window.innerWidth <= 1024) {
                mobileSidebar.style.display = 'block';
            }

            window.addEventListener('resize', () => {
                if (window.innerWidth <= 1024) {
                    mobileSidebar.style.display = 'block';
                } else {
                    mobileSidebar.style.display = 'none';
                }
            });

            function openMobileMenu() {
                mobileSidebar.classList.add('mobile-open');
                mobileOverlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            function closeMobileMenu() {
                mobileSidebar.classList.remove('mobile-open');
                mobileOverlay.classList.remove('active');
                document.body.style.overflow = '';
            }

            mobileMenuBtn.addEventListener('click', openMobileMenu);
            mobileCloseBtn.addEventListener('click', closeMobileMenu);
            mobileOverlay.addEventListener('click', closeMobileMenu);

            // Close menu when clicking a nav link
            document.querySelectorAll('.nav-item').forEach(item => {
                item.addEventListener('click', closeMobileMenu);
            });
        }

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
