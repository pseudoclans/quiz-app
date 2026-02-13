<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $quiz->title }} · QuizApp</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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

    <main class="main" style="max-width: 980px; margin: 0 auto;">
        <div class="page-header" data-reveal data-delay="80">
            <div>
                <div class="page-title">{{ $quiz->title }}</div>
                <div class="page-subtitle">{{ $quiz->description ?? 'Review your quiz content' }}</div>
            </div>
            <span class="badge">Preview</span>
        </div>

        <div class="stack stack-tight" data-reveal data-delay="140">
            @php
                $currentType = null;
                $typeCounter = 0;
            @endphp

            @foreach($quiz->questions as $question)
                @if($question->question_type !== $currentType)
                    @if($currentType !== null)
                        </section>
                    @endif
                    @php
                        $currentType = $question->question_type;
                        $typeCounter++;
                        $typeName = match($currentType) {
                            'multiple_choice' => 'Multiple Choice',
                            'identification' => 'Identification',
                            'true_false' => 'True or False',
                            default => 'Questions'
                        };
                    @endphp
                    <section class="card" data-reveal data-delay="180">
                        <div class="builder-header">
                            <div>
                                <div class="page-title" style="font-size: 1.1rem;">{{ $typeName }}</div>
                                <div class="faint">Section {{ $typeCounter }}</div>
                            </div>
                            <span class="status-pill">{{ $question->question_type === 'true_false' ? $question->answers()->where('is_correct', true)->first()?->answer_text : 'Ready' }}</span>
                        </div>
                        <div class="divider"></div>
                @endif

                <div class="stack stack-tight" style="margin-bottom: 2rem;">
                    <div class="muted">Question {{ $question->question_number }}</div>
                    <div style="font-weight: 600; margin-bottom: 1rem;">{{ $question->question_text }}</div>

                    @if($question->question_type === 'multiple_choice')
                        <div class="stack">
                            @foreach($question->answers as $answer)
                                <div class="option" style="opacity: {{ $answer->is_correct ? '1' : '0.7' }}; padding: 0.75rem 1rem; border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 0.5rem; cursor: default;">
                                    <input type="radio" disabled style="pointer-events: none;" {{ $answer->is_correct ? 'checked' : '' }}>
                                    <span>{{ $answer->answer_letter }}) {{ $answer->answer_text }}</span>
                                    @if($answer->is_correct)
                                        <span style="margin-left: auto; color: #10b981; font-weight: 600;">✓ Correct</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @elseif($question->question_type === 'identification')
                        <div style="background: rgba(16, 185, 129, 0.1); padding: 1rem; border-radius: 0.5rem; border-left: 3px solid #10b981;">
                            <div class="faint" style="font-size: 0.85rem;">Expected Answer:</div>
                            <div style="color: #10b981; font-weight: 600; margin-top: 0.5rem;">{{ $question->answers->first()?->answer_text ?? 'No answer set' }}</div>
                        </div>
                    @elseif($question->question_type === 'true_false')
                        <div class="stack">
                            @foreach($question->answers as $answer)
                                <div class="option" style="opacity: {{ $answer->is_correct ? '1' : '0.7' }}; padding: 0.75rem 1rem; border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 0.5rem; cursor: default;">
                                    <input type="radio" disabled style="pointer-events: none;" {{ $answer->is_correct ? 'checked' : '' }}>
                                    <span>{{ $answer->answer_text }}</span>
                                    @if($answer->is_correct)
                                        <span style="margin-left: auto; color: #10b981; font-weight: 600;">✓ Correct</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach

            </section>

            <div class="card" data-reveal data-delay="260">
                <div class="page-title" style="font-size: 1.1rem;">Quiz Summary</div>
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-top: 1rem;">
                    <div style="padding: 1rem; background: rgba(255, 255, 255, 0.05); border-radius: 0.5rem;">
                        <div class="faint" style="font-size: 0.85rem;">Total Questions</div>
                        <div style="font-size: 1.5rem; font-weight: 600; color: #3b82f6;">{{ $quiz->total_questions }}</div>
                    </div>
                    <div style="padding: 1rem; background: rgba(255, 255, 255, 0.05); border-radius: 0.5rem;">
                        <div class="faint" style="font-size: 0.85rem;">Quiz Title</div>
                        <div style="font-size: 1rem; font-weight: 600;">{{ $quiz->title }}</div>
                    </div>
                    <div style="padding: 1rem; background: rgba(255, 255, 255, 0.05); border-radius: 0.5rem;">
                        <div class="faint" style="font-size: 0.85rem;">Created</div>
                        <div style="font-size: 0.9rem;">{{ $quiz->created_at->format('M d, Y') }}</div>
                    </div>
                </div>
                <div style="margin-top: 2rem; display: flex; gap: 1rem;">
                    <a href="{{ route('quiz.edit', $quiz->id) }}" class="btn btn-outline">Edit Quiz</a>
                    <form method="POST" action="{{ route('quiz.destroy', $quiz->id) }}" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this quiz?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-ghost">Delete</button>
                    </form>
                </div>
            </div>
        </div>
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

        // Theme toggle
        const toggle = document.getElementById('themeToggle');
        const label = document.getElementById('themeLabel');
        const isDark = localStorage.getItem('theme') === 'dark' || !localStorage.getItem('theme');
        
        function setTheme(dark) {
            document.documentElement.style.colorScheme = dark ? 'dark' : 'light';
            toggle.setAttribute('aria-pressed', dark);
            label.textContent = dark ? 'Dark' : 'Light';
            localStorage.setItem('theme', dark ? 'dark' : 'light');
        }

        setTheme(isDark);
        toggle.addEventListener('click', () => setTheme(toggle.getAttribute('aria-pressed') !== 'true'));
    </script>
</body>
</html>
