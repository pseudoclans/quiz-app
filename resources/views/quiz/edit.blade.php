<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Quiz · QuizApp</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .edit-container {
            max-width: 1100px;
            margin: 0 auto;
        }

        .quiz-header-edit {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 0.75rem;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .header-form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: rgba(255, 255, 255, 0.8);
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 0.5rem;
            padding: 0.75rem;
            color: white;
            font-size: 0.95rem;
            font-family: inherit;
        }

        .form-group textarea {
            grid-column: 1 / -1;
            resize: vertical;
            min-height: 80px;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: rgba(59, 130, 246, 0.5);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .btn-update-quiz {
            background: linear-gradient(135deg, #3b82f6, #06b6d4);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-update-quiz:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(59, 130, 246, 0.3);
        }

        .question-list {
            margin-bottom: 2rem;
        }

        .question-item {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 0.75rem;
            padding: 1.5rem;
            margin-bottom: 1rem;
        }

        .question-item.editing {
            background: rgba(59, 130, 246, 0.1);
            border-color: rgba(59, 130, 246, 0.3);
        }

        .question-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .question-num {
            background: rgba(59, 130, 246, 0.2);
            color: #3b82f6;
            padding: 0.25rem 0.75rem;
            border-radius: 0.25rem;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .question-type-badge {
            background: rgba(168, 85, 247, 0.2);
            color: #a855f7;
            padding: 0.25rem 0.75rem;
            border-radius: 0.25rem;
            font-size: 0.85rem;
        }

        .question-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn-icon {
            background: none;
            border: none;
            cursor: pointer;
            padding: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.35rem;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .btn-edit {
            color: #3b82f6;
            background: rgba(59, 130, 246, 0.1);
        }

        .btn-edit:hover {
            background: rgba(59, 130, 246, 0.2);
        }

        .btn-delete {
            color: #ef4444;
            background: rgba(239, 68, 68, 0.1);
        }

        .btn-delete:hover {
            background: rgba(239, 68, 68, 0.2);
        }

        .question-text-display {
            font-weight: 600;
            margin-bottom: 1rem;
            font-size: 1rem;
        }

        .answers-display {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .answer-item {
            background: rgba(255, 255, 255, 0.02);
            padding: 0.75rem;
            border-radius: 0.5rem;
            border-left: 3px solid rgba(255, 255, 255, 0.1);
            font-size: 0.9rem;
        }

        .answer-item.correct {
            border-left-color: #10b981;
            background: rgba(16, 185, 129, 0.1);
        }

        .answer-correct-mark {
            color: #10b981;
            font-weight: 600;
            margin-left: 0.5rem;
        }

        .edit-form {
            display: none;
            background: rgba(255, 255, 255, 0.02);
            padding: 1rem;
            border-radius: 0.5rem;
            border: 1px solid rgba(59, 130, 246, 0.2);
        }

        .edit-form.active {
            display: block;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .btn-save, .btn-cancel {
            padding: 0.6rem 1.2rem;
            border-radius: 0.5rem;
            border: none;
            cursor: pointer;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .btn-save {
            background: rgba(16, 185, 129, 0.2);
            color: #10b981;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .btn-save:hover {
            background: rgba(16, 185, 129, 0.3);
        }

        .btn-cancel {
            background: rgba(239, 68, 68, 0.2);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .btn-cancel:hover {
            background: rgba(239, 68, 68, 0.3);
        }

        .add-question-section {
            background: rgba(16, 185, 129, 0.05);
            border: 2px dashed rgba(16, 185, 129, 0.3);
            border-radius: 0.75rem;
            padding: 1.5rem;
            margin-top: 2rem;
        }

        .add-question-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: #10b981;
        }

        .btn-add-question {
            background: rgba(16, 185, 129, 0.2);
            color: #10b981;
            border: 1px solid rgba(16, 185, 129, 0.3);
            padding: 0.6rem 1.2rem;
            border-radius: 0.5rem;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 1rem;
        }

        .btn-add-question:hover {
            background: rgba(16, 185, 129, 0.3);
        }

        .answer-options {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            margin: 1rem 0;
        }

        .answer-input-row {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .answer-input-row input[type="text"] {
            flex: 1;
        }

        .answer-input-row input[type="radio"] {
            cursor: pointer;
            width: auto;
        }

        .answer-input-row label {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.7);
        }

        .success-message {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #10b981;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
        }

        .empty-questions {
            text-align: center;
            padding: 2rem;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 0.75rem;
            margin-bottom: 2rem;
        }

        /* Mobile Responsive Styles for Edit Page */
        @media (max-width: 768px) {
            .edit-container {
                padding: 0;
            }

            .header-form {
                grid-template-columns: 1fr;
            }

            .quiz-header-edit {
                padding: 1rem;
            }

            .question-item {
                padding: 1rem;
            }

            .question-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .question-actions {
                width: 100%;
                justify-content: flex-start;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .answer-input-row {
                flex-wrap: wrap;
            }

            .add-question-section {
                padding: 1rem;
            }

            .btn-save, .btn-cancel {
                flex: 1;
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

    <main class="main edit-container">
        <div class="page-header" data-reveal data-delay="80">
            <div>
                <div class="page-title">Edit Quiz</div>
                <div class="page-subtitle">Manage questions, add new ones, or edit existing content</div>
            </div>
            <span class="badge">{{ $quiz->total_questions }} Questions</span>
        </div>

        @if(session('success'))
            <div class="success-message" data-reveal data-delay="120">
                {{ session('success') }}
            </div>
        @endif

        <!-- Quiz Header Edit -->
        <div class="quiz-header-edit" data-reveal data-delay="100">
            <form method="POST" action="{{ route('quiz.update', $quiz->id) }}" id="updateQuizForm">
                @csrf
                @method('PUT')
                
                <div class="header-form">
                    <div class="form-group">
                        <label for="title">Quiz Title</label>
                        <input type="text" id="title" name="title" value="{{ $quiz->title }}" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" id="description" name="description" value="{{ $quiz->description ?? '' }}">
                    </div>
                </div>
                
                <button type="submit" class="btn-update-quiz">💾 Update Quiz Details</button>
            </form>
        </div>

        <!-- Questions List -->
        <div class="question-list" data-reveal data-delay="120">
            <h2 style="font-size: 1.2rem; margin-bottom: 1.5rem;">Questions</h2>

            @if($quiz->questions->isEmpty())
                <div class="empty-questions">
                    <div style="font-size: 2rem; margin-bottom: 0.5rem;">📝</div>
                    <div style="font-weight: 600; margin-bottom: 0.25rem;">No questions yet</div>
                    <div style="color: rgba(255, 255, 255, 0.6); font-size: 0.9rem;">Add your first question below to get started</div>
                </div>
            @else
                @foreach($quiz->questions as $question)
                    <div class="question-item" id="question-{{ $question->id }}">
                        <div class="question-header">
                            <div style="display: flex; gap: 0.75rem; align-items: center;">
                                <span class="question-num">Q{{ $question->question_number }}</span>
                                <span class="question-type-badge">{{ ucfirst(str_replace('_', ' ', $question->question_type)) }}</span>
                            </div>
                            <div class="question-actions">
                                <button type="button" class="btn-icon btn-edit" onclick="toggleEditForm({{ $question->id }})">✎ Edit</button>
                                <form method="POST" action="{{ route('question.delete', [$quiz->id, $question->id]) }}" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this question?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-icon btn-delete">🗑 Delete</button>
                                </form>
                            </div>
                        </div>

                        <!-- Display View -->
                        <div class="display-view-{{ $question->id }}">
                            <div class="question-text-display">{{ $question->question_text }}</div>
                            <div class="answers-display">
                                @foreach($question->answers as $answer)
                                    <div class="answer-item {{ $answer->is_correct ? 'correct' : '' }}">
                                        @if($question->question_type === 'multiple_choice')
                                            <strong>{{ strtoupper($answer->answer_letter) }})</strong> {{ $answer->answer_text }}
                                        @else
                                            {{ $answer->answer_text }}
                                        @endif
                                        @if($answer->is_correct)
                                            <span class="answer-correct-mark">✓ Correct</span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Edit Form -->
                        <form method="POST" action="{{ route('question.update', [$quiz->id, $question->id]) }}" class="edit-form edit-form-{{ $question->id }}">
                            @csrf
                            @method('PUT')
                            
                            <div class="form-group">
                                <label for="question_text_{{ $question->id }}">Question Text</label>
                                <textarea id="question_text_{{ $question->id }}" name="question_text" required>{{ $question->question_text }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Answers</label>
                                <div class="answer-options">
                                    @if($question->question_type === 'multiple_choice')
                                        @foreach($question->answers as $answerIndex => $answer)
                                            <div class="answer-input-row">
                                                <input type="text" name="answers[{{ $answerIndex }}][text]" value="{{ $answer->answer_text }}" placeholder="Answer option" required>
                                                <input type="radio" name="correct_answer" value="{{ $answerIndex }}" {{ $answer->is_correct ? 'checked' : '' }}>
                                                <label>Correct</label>
                                            </div>
                                        @endforeach
                                    @elseif($question->question_type === 'identification')
                                        <input type="text" name="correct_answer" value="{{ $question->answers->first()->answer_text }}" placeholder="Correct answer" required style="background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 0.5rem; padding: 0.75rem; color: white;">
                                    @elseif($question->question_type === 'true_false')
                                        <div class="answer-input-row">
                                            <input type="radio" name="correct_answer" value="true" {{ $question->answers->firstWhere('answer_text', 'True')?->is_correct ? 'checked' : '' }}>
                                            <label>True</label>
                                        </div>
                                        <div class="answer-input-row">
                                            <input type="radio" name="correct_answer" value="false" {{ $question->answers->firstWhere('answer_text', 'False')?->is_correct ? 'checked' : '' }}>
                                            <label>False</label>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div style="display: flex; gap: 0.75rem;">
                                <button type="submit" class="btn-save">✓ Save Changes</button>
                                <button type="button" class="btn-cancel" onclick="toggleEditForm({{ $question->id }})">Cancel</button>
                            </div>
                        </form>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- Add Question Section -->
        <div class="add-question-section" data-reveal data-delay="140">
            <div class="add-question-title">➕ Add New Question</div>
            <form method="POST" action="{{ route('question.add', $quiz->id) }}" id="addQuestionForm">
                @csrf
                
                <div class="form-group">
                    <label for="new_question_text">Question Text</label>
                    <textarea id="new_question_text" name="question_text" placeholder="Enter your question..." required></textarea>
                </div>

                <div class="form-group">
                    <label for="new_question_type">Question Type</label>
                    <select id="new_question_type" name="question_type" onchange="updateAnswerOptions()" required>
                        <option value="multiple_choice">Multiple Choice (A, B, C, D)</option>
                        <option value="identification">Identification (Fill in the blank)</option>
                        <option value="true_false">True or False</option>
                    </select>
                </div>

                <div class="form-group" id="answers-options-container">
                    <!-- Dynamically generated based on question type -->
                </div>

                <button type="submit" class="btn-add-question">+ Add Question</button>
            </form>
        </div>

        <!-- Navigation -->
        <div style="margin-top: 2rem; display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <a href="{{ route('quiz.show', $quiz->id) }}" class="btn btn-outline">👁 View Quiz</a>
            <a href="{{ route('quiz.take', $quiz->id) }}" class="btn btn-primary">📝 Take Quiz</a>
            <a href="{{ route('quiz.index') }}" class="btn btn-ghost">← Back</a>
        </div>
    </main>

    <script>
        function toggleEditForm(questionId) {
            const displayView = document.querySelector(`.display-view-${questionId}`);
            const editForm = document.querySelector(`.edit-form-${questionId}`);
            const questionItem = document.getElementById(`question-${questionId}`);
            
            displayView.style.display = displayView.style.display === 'none' ? 'block' : 'none';
            editForm.classList.toggle('active');
            questionItem.classList.toggle('editing');
        }

        function updateAnswerOptions() {
            const questionType = document.getElementById('new_question_type').value;
            const container = document.getElementById('answers-options-container');
            
            if (questionType === 'multiple_choice') {
                container.innerHTML = `
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: rgba(255, 255, 255, 0.8);">Answer Options</label>
                    <div class="answer-options">
                        <div class="answer-input-row">
                            <input type="text" name="answers[0][text]" placeholder="Option A" required style="background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 0.5rem; padding: 0.75rem; color: white;">
                            <input type="radio" name="correct_answer" value="0" checked>
                            <label>Correct</label>
                        </div>
                        <div class="answer-input-row">
                            <input type="text" name="answers[1][text]" placeholder="Option B" required style="background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 0.5rem; padding: 0.75rem; color: white;">
                            <input type="radio" name="correct_answer" value="1">
                            <label>Correct</label>
                        </div>
                        <div class="answer-input-row">
                            <input type="text" name="answers[2][text]" placeholder="Option C" required style="background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 0.5rem; padding: 0.75rem; color: white;">
                            <input type="radio" name="correct_answer" value="2">
                            <label>Correct</label>
                        </div>
                        <div class="answer-input-row">
                            <input type="text" name="answers[3][text]" placeholder="Option D" required style="background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 0.5rem; padding: 0.75rem; color: white;">
                            <input type="radio" name="correct_answer" value="3">
                            <label>Correct</label>
                        </div>
                    </div>
                `;
            } else if (questionType === 'identification') {
                container.innerHTML = `
                    <label for="correct_answer_text" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: rgba(255, 255, 255, 0.8);">Correct Answer</label>
                    <input type="text" id="correct_answer_text" name="correct_answer" placeholder="Type the correct answer" required style="width: 100%; background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 0.5rem; padding: 0.75rem; color: white;">
                `;
            } else if (questionType === 'true_false') {
                container.innerHTML = `
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: rgba(255, 255, 255, 0.8);">Correct Answer</label>
                    <div class="answer-options">
                        <div class="answer-input-row">
                            <input type="radio" name="correct_answer" value="true" checked>
                            <label>True</label>
                        </div>
                        <div class="answer-input-row">
                            <input type="radio" name="correct_answer" value="false">
                            <label>False</label>
                        </div>
                    </div>
                `;
            }
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', updateAnswerOptions);
    </script>

    @vite(['resources/js/app.js'])
</body>
</html>
