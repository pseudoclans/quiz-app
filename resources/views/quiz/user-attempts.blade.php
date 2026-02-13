<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} - Quiz History · QuizApp</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .user-profile {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1rem;
            padding: 2rem;
            margin-bottom: 2rem;
            text-align: center;
        }

        .user-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6, #06b6d4);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: 600;
            margin: 0 auto 1rem;
            color: white;
        }

        .user-name {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .user-email {
            color: rgba(255, 255, 255, 0.6);
            margin-bottom: 1.5rem;
        }

        .user-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 0.75rem;
            padding: 1rem;
            text-align: center;
        }

        .stat-label {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-size: 1.75rem;
            font-weight: 600;
            background: linear-gradient(135deg, #3b82f6, #06b6d4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .attempt-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 0.75rem;
            padding: 1.5rem;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }

        .attempt-card:hover {
            background: rgba(255, 255, 255, 0.06);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .attempt-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .attempt-quiz {
            flex: 1;
        }

        .attempt-title {
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 0.25rem;
        }

        .attempt-date {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.6);
        }

        .attempt-score {
            text-align: right;
        }

        .score-badge {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 600;
            font-size: 1rem;
        }

        .score-excellent {
            background: rgba(16, 185, 129, 0.2);
            color: #10b981;
        }

        .score-good {
            background: rgba(59, 130, 246, 0.2);
            color: #3b82f6;
        }

        .score-fair {
            background: rgba(245, 158, 11, 0.2);
            color: #fbbf24;
        }

        .score-poor {
            background: rgba(239, 68, 68, 0.2);
            color: #f87171;
        }

        .attempt-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .attempt-stat {
            background: rgba(255, 255, 255, 0.03);
            padding: 0.75rem;
            border-radius: 0.5rem;
            text-align: center;
        }

        .attempt-stat-label {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.6);
            margin-bottom: 0.25rem;
        }

        .attempt-stat-value {
            font-size: 1.1rem;
            font-weight: 600;
            color: #3b82f6;
        }

        .attempt-actions {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .btn-small {
            padding: 0.5rem 1rem;
            font-size: 0.85rem;
            border-radius: 0.5rem;
            text-decoration: none;
            cursor: pointer;
            border: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-view {
            background: rgba(59, 130, 246, 0.2);
            color: #3b82f6;
            border: 1px solid rgba(59, 130, 246, 0.3);
        }

        .btn-view:hover {
            background: rgba(59, 130, 246, 0.3);
            border-color: rgba(59, 130, 246, 0.5);
        }

        .progress-bar {
            height: 6px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 3px;
            overflow: hidden;
            margin-top: 0.75rem;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #3b82f6, #06b6d4);
            border-radius: 3px;
        }

        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 0.75rem;
        }

        .empty-state-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .empty-state-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .empty-state-text {
            color: rgba(255, 255, 255, 0.6);
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 2rem;
        }

        .pagination a, .pagination span {
            padding: 0.5rem 0.75rem;
            border-radius: 0.5rem;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            text-decoration: none;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .pagination a:hover {
            background: rgba(255, 255, 255, 0.15);
        }

        .pagination .active {
            background: rgba(59, 130, 246, 0.3);
            border-color: rgba(59, 130, 246, 0.5);
            color: #3b82f6;
        }
    </style>
</head>
<body class="page">
    <div class="mesh-bg"></div>
    <div class="mesh-glow"></div>

    <header class="topbar glass">
        <div class="topbar-inner">
            <a href="{{ route('quiz.history') }}" class="btn btn-ghost">← Back to All History</a>
            <div class="page-title" style="font-size: 1.2rem;">User Attempts</div>
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

    <main class="main" style="max-width: 1000px; margin: 0 auto;">
        <div class="page-header" data-reveal data-delay="80">
            <div>
                <div class="page-title">Quiz History</div>
                <div class="page-subtitle">{{ $user->name }}'s quiz attempts and performance</div>
            </div>
            <span class="badge">{{ $attempts->total() }} Attempts</span>
        </div>

        <!-- User Profile Card -->
        <div class="user-profile" data-reveal data-delay="120">
            <div class="user-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
            <div class="user-name">{{ $user->name }}</div>
            <div class="user-email">{{ $user->email }}</div>

            <div class="user-stats">
                @php
                    $totalAttempts = $user->attempts()->count();
                    $totalCorrect = $user->attempts()->sum('score');
                    $totalQuestions = $user->attempts()->sum('total_questions');
                    $avgScore = $totalQuestions > 0 ? round(($totalCorrect / $totalQuestions) * 100, 1) : 0;
                @endphp
                <div class="stat-card">
                    <div class="stat-label">Total Attempts</div>
                    <div class="stat-value">{{ $totalAttempts }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Total Correct</div>
                    <div class="stat-value" style="color: #10b981;">{{ $totalCorrect }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Total Questions</div>
                    <div class="stat-value">{{ $totalQuestions }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Average Score</div>
                    <div class="stat-value">{{ $avgScore }}%</div>
                </div>
            </div>
        </div>

        <!-- Attempts List -->
        @if($attempts->count() > 0)
            <div data-reveal data-delay="140">
                @foreach($attempts as $attempt)
                    @php
                        $percentage = $attempt->total_questions > 0 
                            ? round(($attempt->score / $attempt->total_questions) * 100, 2)
                            : 0;
                        
                        if ($percentage >= 80) {
                            $scoreClass = 'score-excellent';
                        } elseif ($percentage >= 70) {
                            $scoreClass = 'score-good';
                        } elseif ($percentage >= 50) {
                            $scoreClass = 'score-fair';
                        } else {
                            $scoreClass = 'score-poor';
                        }
                    @endphp
                    <div class="attempt-card">
                        <div class="attempt-header">
                            <div class="attempt-quiz">
                                <div class="attempt-title">{{ $attempt->quiz->title }}</div>
                                <div class="attempt-date">{{ $attempt->created_at->format('M d, Y h:i A') }}</div>
                            </div>
                            <div class="attempt-score">
                                <div class="score-badge {{ $scoreClass }}">
                                    {{ round($percentage) }}%
                                </div>
                            </div>
                        </div>

                        <div class="attempt-stats">
                            <div class="attempt-stat">
                                <div class="attempt-stat-label">Score</div>
                                <div class="attempt-stat-value">{{ $attempt->score }}/{{ $attempt->total_questions }}</div>
                            </div>
                            <div class="attempt-stat">
                                <div class="attempt-stat-label">Correct</div>
                                <div class="attempt-stat-value" style="color: #10b981;">{{ $attempt->score }}</div>
                            </div>
                            <div class="attempt-stat">
                                <div class="attempt-stat-label">Wrong</div>
                                <div class="attempt-stat-value" style="color: #ef4444;">{{ $attempt->total_questions - $attempt->score }}</div>
                            </div>
                            <div class="attempt-stat">
                                <div class="attempt-stat-label">Time</div>
                                <div class="attempt-stat-value">{{ $attempt->created_at->diffInMinutes(now()) }}m</div>
                            </div>
                        </div>

                        <div class="progress-bar">
                            <div class="progress-fill" style="width: {{ $percentage }}%;"></div>
                        </div>

                        <div class="attempt-actions" style="margin-top: 1rem;">
                            <a href="{{ route('quiz.results', ['quiz' => $attempt->quiz_id, 'attempt' => $attempt->id]) }}" class="btn-small btn-view">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                                View Details
                            </a>
                        </div>
                    </div>
                @endforeach

                <div class="pagination">
                    {{ $attempts->links() }}
                </div>
            </div>
        @else
            <div class="empty-state" data-reveal data-delay="120">
                <div class="empty-state-icon">📝</div>
                <div class="empty-state-title">No Quiz Attempts</div>
                <div class="empty-state-text">{{ $user->name }} hasn't taken any quizzes yet.</div>
            </div>
        @endif
    </main>

    @vite(['resources/js/app.js'])
</body>
</html>
