<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Quiz · QuizApp</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="page">
    <div class="mesh-bg"></div>
    <div class="mesh-glow"></div>

    <div class="app-shell">
        <aside class="sidebar glass">
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
                <a href="{{ route('quiz.edit', $quiz['id']) }}" class="nav-item active">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    Edit Quiz
                </a>
            </nav>
        </aside>

        <section>
            <header class="topbar glass">
                <div class="topbar-inner">
                    <a href="{{ route('quiz.index') }}" class="btn btn-ghost">← Back to Dashboard</a>
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
                        <div class="page-title">Edit Quiz</div>
                        <div class="page-subtitle">Refine your questions and adjust sets.</div>
                    </div>
                    <span class="badge">Editing</span>
                </div>

                <form method="POST" action="{{ route('quiz.update', $quiz['id']) }}" class="stack" data-reveal data-delay="120">
                    @csrf

                    <div class="card">
                        <div class="form-group">
                            <label for="title">Quiz Title</label>
                            <input type="text" id="title" name="title" class="input" value="{{ $quiz['title'] }}" required>
                        </div>
                    </div>

                    @foreach($quiz['sets'] as $setIndex => $set)
                        <div class="builder-set" data-reveal data-delay="{{ 140 + ($loop->index * 60) }}">
                            <div class="builder-header">
                                <div>
                                    <div class="page-title" style="font-size: 1.1rem;">Set {{ $set['set_number'] }}</div>
                                    <div class="faint">{{ ucfirst(str_replace('_', ' ', $set['type'])) }}</div>
                                </div>
                                <span class="badge">Locked Type</span>
                            </div>

                            <input type="hidden" name="sets[{{ $setIndex }}][type]" value="{{ $set['type'] }}">

                            @foreach($set['questions'] as $qIndex => $question)
                                <div class="card" style="margin-bottom: 16px;">
                                    <div class="builder-header">
                                        <div class="page-title" style="font-size: 1rem;">Question {{ $qIndex + 1 }}</div>
                                    </div>
                                    <input type="hidden" name="sets[{{ $setIndex }}][questions][{{ $qIndex }}][id]" value="{{ $question['id'] }}">
                                    <div class="form-group">
                                        <label>Question</label>
                                        <input type="text" name="sets[{{ $setIndex }}][questions][{{ $qIndex }}][question]" class="input" value="{{ $question['question'] }}" required>
                                    </div>

                                    @if($set['type'] === 'multiple_choice')
                                        <div class="form-group">
                                            <label>Choices</label>
                                            @foreach($question['choices'] as $cIndex => $choice)
                                                <input type="text" name="sets[{{ $setIndex }}][questions][{{ $qIndex }}][choices][]" class="input" value="{{ $choice }}" required>
                                            @endforeach
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label>Correct Answer</label>
                                        <input type="text" name="sets[{{ $setIndex }}][questions][{{ $qIndex }}][correct_answer]" class="input" value="{{ $question['correct_answer'] }}" required>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach

                    <div class="card">
                        <div class="stack">
                            <a href="{{ route('quiz.index') }}" class="btn btn-ghost">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Quiz</button>
                        </div>
                    </div>
                </form>
            </main>
        </section>
    </div>
</body>
</html>
