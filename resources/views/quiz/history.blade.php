<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz History · QuizApp</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .history-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 0.75rem;
            padding: 1.5rem;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }

        .history-card:hover {
            background: rgba(255, 255, 255, 0.06);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .history-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .history-info {
            flex: 1;
        }

        .history-title {
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 0.25rem;
        }

        .history-meta {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.6);
        }

        .history-score {
            text-align: right;
        }

        .score-badge {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
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

        .score-percentage {
            display: block;
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.6);
            margin-top: 0.5rem;
        }

        .history-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .stat-item {
            background: rgba(255, 255, 255, 0.03);
            padding: 0.75rem;
            border-radius: 0.5rem;
            text-align: center;
        }

        .stat-label {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.6);
            margin-bottom: 0.25rem;
        }

        .stat-value {
            font-size: 1.25rem;
            font-weight: 600;
            color: #3b82f6;
        }

        .history-actions {
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

        .btn-user {
            background: rgba(168, 85, 247, 0.2);
            color: #a855f7;
            border: 1px solid rgba(168, 85, 247, 0.3);
        }

        .btn-user:hover {
            background: rgba(168, 85, 247, 0.3);
            border-color: rgba(168, 85, 247, 0.5);
        }

        .filters {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .filter-input {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 0.5rem;
            padding: 0.75rem;
            color: white;
            font-size: 0.9rem;
        }

        .filter-input::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        .filter-input:focus {
            outline: none;
            border-color: rgba(59, 130, 246, 0.5);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
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

        /* Mobile Responsive Styles for History Page */
        @media (max-width: 768px) {
            .history-card {
                padding: 1rem;
            }

            .history-header {
                flex-direction: column;
            }

            .history-score {
                text-align: left;
                width: 100%;
            }

            .history-stats {
                grid-template-columns: 1fr;
                gap: 0.5rem;
            }

            .stat-item {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .stat-label {
                text-align: left;
            }

            .stat-value {
                font-size: 1.1rem;
            }

            .history-actions {
                flex-direction: column;
            }

            .btn-small {
                width: 100%;
                justify-content: center;
            }

            .filters {
                flex-direction: column;
            }

            .filter-input {
                width: 100%;
                max-width: 100% !important;
            }
        }
    </style>
</head>
<body class="page">
    <div class="mesh-bg"></div>
    <div class="mesh-glow"></div>

    <header class="topbar glass">
        <div class="topbar-inner">
            <a href="{{ route('quiz.index') }}" class="btn btn-ghost">← Back to Dashboard</a>
            <div class="page-title" style="font-size: 1.2rem;">Quiz History</div>
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
                <div class="page-subtitle">Track all quiz attempts across all users</div>
            </div>
            <span class="badge">{{ $attempts->total() }} Attempts</span>
        </div>

        @if($attempts->count() > 0)
            <div class="filters" data-reveal data-delay="120">
                <input type="text" class="filter-input" placeholder="Search quiz title..." id="searchInput" style="flex: 1; max-width: 300px;">
            </div>

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
                    <div class="history-card">
                        <div class="history-header">
                            <div class="history-info">
                                <div class="history-title">{{ $attempt->quiz->title }}</div>
                                <div class="history-meta">
                                    {{ $attempt->user->name ?? 'Guest' }} 
                                    • {{ $attempt->created_at->format('M d, Y h:i A') }}
                                </div>
                            </div>
                            <div class="history-score">
                                <div class="score-badge {{ $scoreClass }}">
                                    {{ $attempt->score }}/{{ $attempt->total_questions }}
                                    <span class="score-percentage">{{ round($percentage) }}%</span>
                                </div>
                            </div>
                        </div>

                        <div class="history-stats">
                            <div class="stat-item">
                                <div class="stat-label">Correct</div>
                                <div class="stat-value" style="color: #10b981;">{{ $attempt->score }}</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-label">Wrong</div>
                                <div class="stat-value" style="color: #ef4444;">{{ $attempt->total_questions - $attempt->score }}</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-label">Duration</div>
                                <div class="stat-value">{{ $attempt->created_at->diffInMinutes(now()) }} min</div>
                            </div>
                        </div>

                        <div class="history-actions">
                            <a href="{{ route('quiz.results', ['quiz' => $attempt->quiz_id, 'attempt' => $attempt->id]) }}" class="btn-small btn-view">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                                View Results
                            </a>
                            <a href="{{ route('user.attempts', $attempt->user_id) }}" class="btn-small btn-user">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                                    <circle cx="12" cy="7" r="4" />
                                </svg>
                                User History
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
                <div class="empty-state-icon">📊</div>
                <div class="empty-state-title">No Quiz Attempts Yet</div>
                <div class="empty-state-text">Users haven't taken any quizzes yet. Check back later!</div>
            </div>
        @endif
    </main>

    <script>
        // Simple search functionality
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const query = this.value.toLowerCase();
                document.querySelectorAll('.history-card').forEach(card => {
                    const title = card.querySelector('.history-title').textContent.toLowerCase();
                    card.style.display = title.includes(query) ? 'block' : 'none';
                });
            });
        }
    </script>

    @vite(['resources/js/app.js'])
</body>
</html>
