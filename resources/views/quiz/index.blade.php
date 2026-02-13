<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard · QuizApp</title>
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
                <a href="{{ route('quiz.index') }}" class="nav-item active">
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
                <a href="#" class="nav-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                    </svg>
                    Settings
                </a>
            </nav>
        </aside>

        <section>
            <header class="topbar glass">
                <div class="topbar-inner">
                    <div class="search">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8" />
                            <path d="M21 21l-4.3-4.3" />
                        </svg>
                        <input type="search" placeholder="Search quizzes, users, topics" />
                    </div>
                    <div class="topbar-actions">
                        <button class="icon-btn" id="themeToggle" aria-pressed="false">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 3a9 9 0 100 18 9 9 0 000-18z" />
                            </svg>
                        </button>
                        <div class="icon-btn" title="Notifications">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M18 8a6 6 0 00-12 0c0 7-3 7-3 7h18s-3 0-3-7" />
                                <path d="M13.73 21a2 2 0 01-3.46 0" />
                            </svg>
                        </div>
                        <div class="icon-btn" title="Profile">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                                <circle cx="12" cy="7" r="4" />
                            </svg>
                        </div>
                        <span class="faint" id="themeLabel">Dark</span>
                    </div>
                </div>
            </header>

            <main class="main">
                <div class="page-header" data-reveal data-delay="60">
                    <div>
                        <div class="page-title">Dashboard</div>
                        <div class="page-subtitle">High‑level performance of your quiz program.</div>
                    </div>
                    <div class="btn btn-outline">Last 30 days</div>
                </div>

                <section class="metrics" data-reveal data-delay="140">
                    <div class="card">
                        <div class="metric">
                            <div class="metric-label">Quizzes</div>
                            <div class="metric-value">{{ count($quizzes) }}</div>
                            <div class="metric-trend">+12% MoM</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="metric">
                            <div class="metric-label">Users</div>
                            <div class="metric-value">2,480</div>
                            <div class="metric-trend">+8.4% MoM</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="metric">
                            <div class="metric-label">Attempts</div>
                            <div class="metric-value">18,942</div>
                            <div class="metric-trend">+22% MoM</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="metric">
                            <div class="metric-label">Revenue</div>
                            <div class="metric-value">$42.6k</div>
                            <div class="metric-trend">+15% MoM</div>
                        </div>
                    </div>
                </section>

                @if(session('success'))
                    <div class="card mt-24" data-reveal data-delay="200">
                        <strong>Success</strong>
                        <div class="muted">{{ session('success') }}</div>
                    </div>
                @endif

                <section class="card mt-32" data-reveal data-delay="220">
                    <div class="page-header" style="margin: 0 0 16px;">
                        <div>
                            <div class="page-title" style="font-size: 1.4rem;">Quiz Management</div>
                            <div class="page-subtitle">Manage, edit, and launch quizzes.</div>
                        </div>
                        <a href="{{ route('quiz.create') }}" class="btn btn-primary">Create Quiz</a>
                    </div>

                    @if(count($quizzes) === 0)
                        <div class="card" style="background: rgba(225, 6, 0, 0.05);">
                            <div class="page-title" style="font-size: 1.2rem;">No quizzes yet</div>
                            <div class="page-subtitle">Start by creating your first premium quiz experience.</div>
                            <div class="mt-24">
                                <a href="{{ route('quiz.create') }}" class="btn btn-primary">Create your first quiz</a>
                            </div>
                        </div>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Sets</th>
                                    <th>Questions</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($quizzes as $quiz)
                                    <tr>
                                        <td>
                                            <strong>{{ $quiz->title }}</strong>
                                            <div class="faint">Updated {{ $quiz->updated_at->diffForHumans() }}</div>
                                        </td>
                                        <td>{{ $quiz->questions->groupBy('question_type')->count() }}</td>
                                        <td>{{ $quiz->questions->count() }}</td>
                                        <td><span class="status-pill">Active</span></td>
                                        <td>
                                            <a href="{{ route('quiz.take', $quiz->id) }}" class="btn btn-primary" style="font-size: 0.85rem; padding: 0.5rem 1rem;">Take Quiz</a>
                                            <a href="{{ route('quiz.show', $quiz->id) }}" class="btn btn-outline" style="font-size: 0.85rem; padding: 0.5rem 1rem;">View</a>
                                            <a href="{{ route('quiz.edit', $quiz->id) }}" class="btn btn-ghost" style="font-size: 0.85rem; padding: 0.5rem 1rem;">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </section>

                <section class="card mt-32" data-reveal data-delay="280">
                    <div class="page-title" style="font-size: 1.4rem;">Live Activity</div>
                    <div class="page-subtitle">Loading latest quiz activity...</div>
                    <div class="space-16">
                        <div class="skeleton" style="width: 60%;"></div>
                        <div class="skeleton" style="width: 90%; margin-top: 12px;"></div>
                        <div class="skeleton" style="width: 72%; margin-top: 12px;"></div>
                    </div>
                </section>
            </main>
        </section>
    </div>

    <a href="{{ route('quiz.create') }}" class="fab">
        <span>+ Create Quiz</span>
    </a>
</body>
</html>
