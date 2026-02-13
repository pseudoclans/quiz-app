<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results · {{ $quiz['title'] }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="page">
    <div class="mesh-bg"></div>
    <div class="mesh-glow"></div>

    <header class="topbar glass">
        <div class="topbar-inner">
            <a href="{{ route('quiz.index') }}" class="btn btn-ghost">← Back to Dashboard</a>
            <div class="page-title" style="font-size: 1.2rem;">Results</div>
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
                <div class="page-title">{{ $quiz['title'] }}</div>
                <div class="page-subtitle">Performance overview and answer review.</div>
            </div>
            <span class="badge">Session Complete</span>
        </div>

        <section class="card" data-reveal data-delay="140">
            <div class="metrics">
                <div class="metric">
                    <div class="metric-label">Score</div>
                    <div class="metric-value">{{ $score }}%</div>
                    <div class="metric-trend">{{ $correct }} / {{ $total }} correct</div>
                </div>
                <div class="metric">
                    <div class="metric-label">Accuracy</div>
                    <div class="metric-value">{{ round(($correct / max($total, 1)) * 100) }}%</div>
                    <div class="metric-trend">Above last session</div>
                </div>
                <div class="metric">
                    <div class="metric-label">Confidence</div>
                    <div class="metric-value">High</div>
                    <div class="metric-trend">Strong finish</div>
                </div>
            </div>
        </section>

        <section class="card mt-32" data-reveal data-delay="200">
            <div class="page-title" style="font-size: 1.4rem;">Answer Review</div>
            <div class="page-subtitle">Detailed breakdown of each response.</div>
            <div class="divider"></div>

            <div class="stack">
                @foreach($results as $result)
                    <div class="card" style="background: rgba(255,255,255,0.03); border-left: 3px solid {{ $result['is_correct'] ? '#2eea8c' : '#e10600' }};" data-reveal data-delay="{{ 220 + ($loop->index * 60) }}">
                        <div class="builder-header">
                            <div>
                                <div style="font-weight: 600;">{{ $result['question'] }}</div>
                                <div class="faint">Question {{ $loop->iteration }}</div>
                            </div>
                            <span class="badge">{{ $result['is_correct'] ? 'Correct' : 'Incorrect' }}</span>
                        </div>

                        <div class="stack">
                            <div class="muted">Your Answer: <strong style="color: {{ $result['is_correct'] ? '#2eea8c' : '#ffb3b0' }};">{{ $result['user_answer'] ?: 'No answer' }}</strong></div>
                            @if(!$result['is_correct'])
                                <div class="muted">Correct Answer: <strong style="color: #2eea8c;">{{ $result['correct_answer'] }}</strong></div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="mt-32" data-reveal data-delay="260">
            <div class="stack">
                <a href="{{ route('quiz.show', $quiz['id']) }}" class="btn btn-primary">Retake Quiz</a>
                <a href="{{ route('quiz.index') }}" class="btn btn-outline">Back to Dashboard</a>
            </div>
        </section>
    </main>
</body>
</html>
