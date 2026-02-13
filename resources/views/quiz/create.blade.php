<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Quiz · QuizApp</title>
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
                <a href="{{ route('quiz.create') }}" class="nav-item active">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 4v16m8-8H4" />
                    </svg>
                    Create Quiz
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
                        <div class="page-title">Create New Quiz</div>
                        <div class="page-subtitle">Build a high‑impact quiz with precise sets and questions.</div>
                    </div>
                </div>

                <!-- Toggle between Manual and Paste modes -->
                <div class="card" data-reveal data-delay="100" style="margin-bottom: 2rem;">
                    <div class="form-group">
                        <label>Creation Mode</label>
                        <div style="display: flex; gap: 1rem;">
                            <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                                <input type="radio" name="mode" value="manual" checked id="modeManual">
                                <span>Manual Builder</span>
                            </label>
                            <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                                <input type="radio" name="mode" value="paste" id="modePaste">
                                <span>Paste Content</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- MANUAL MODE -->
                <div id="manualMode">
                    <form id="quizForm" method="POST" action="{{ route('quiz.store') }}" class="stack" data-reveal data-delay="120">
                        @csrf
                        <input type="hidden" name="mode" value="manual">

                        <div class="card">
                            <div class="form-group">
                                <label for="title">Quiz Title</label>
                                <input type="text" id="title" name="title" class="input" placeholder="Enter quiz title" required>
                            </div>
                        </div>

                        <div id="setsContainer"></div>

                        <div class="card">
                            <div class="stack">
                                <div class="stack-tight">
                                    <button type="button" class="btn btn-outline" onclick="addSet()">+ Add Set</button>
                                </div>
                                <div class="stack">
                                    <a href="{{ route('quiz.index') }}" class="btn btn-ghost">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Create Quiz</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- PASTE MODE -->
                <div id="pasteMode" style="display: none;">
                    <form id="pasteForm" method="POST" action="{{ route('quiz.store') }}" class="stack" data-reveal data-delay="120">
                        @csrf
                        <input type="hidden" name="mode" value="paste">

                        <div class="card">
                            <div class="form-group">
                                <label for="pasteTitle">Quiz Title</label>
                                <input type="text" id="pasteTitle" name="title" class="input" placeholder="Enter quiz title" required>
                            </div>
                            <div class="form-group">
                                <label for="pasteDesc">Description (Optional)</label>
                                <textarea id="pasteDesc" name="description" class="input" placeholder="Quiz description" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="pasteContent">Quiz Content</label>
                                <small class="faint" style="display: block; margin-bottom: 0.5rem;">Paste your entire quiz with PART I, PART II, PART III, and answer key</small>
                                <textarea id="pasteContent" name="quiz_content" class="input" placeholder="PART I – Multiple Choice&#10;&#10;Question here:&#10;a) Answer&#10;b) Answer&#10;c) Answer&#10;d) Answer&#10;&#10;..." rows="16" required></textarea>
                            </div>
                        </div>

                        <div class="card">
                            <div class="stack">
                                <button type="button" class="btn btn-outline" onclick="previewPaste()">👁️ Preview</button>
                                <div style="display: flex; gap: 1rem;">
                                    <a href="{{ route('quiz.index') }}" class="btn btn-ghost">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Create Quiz</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Preview Modal -->
                    <div id="previewModal" style="display: none; position: fixed; inset: 0; background: rgba(0, 0, 0, 0.85); z-index: 1000; overflow-y: auto; backdrop-filter: blur(4px);">
                        <div style="min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 2rem;">
                            <div style="background: linear-gradient(135deg, #1a1a1a 0%, #2d0a0a 100%); border: 2px solid #dc2626; border-radius: 1.25rem; padding: 2.5rem; max-width: 950px; width: 95%; max-height: 88vh; overflow-y: auto; box-shadow: 0 25px 50px -12px rgba(220, 38, 38, 0.25), 0 0 0 1px rgba(220, 38, 38, 0.1);">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 2px solid rgba(220, 38, 38, 0.3);">
                                    <h2 style="margin: 0; font-size: 1.75rem; font-weight: 700; color: #fff; text-shadow: 0 0 20px rgba(220, 38, 38, 0.3);">📋 Quiz Preview</h2>
                                    <button type="button" onclick="closePreview()" style="background: rgba(220, 38, 38, 0.1); border: 1px solid #dc2626; font-size: 1.5rem; cursor: pointer; color: #dc2626; width: 36px; height: 36px; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; transition: all 0.2s;" onmouseover="this.style.background='#dc2626'; this.style.color='#fff'" onmouseout="this.style.background='rgba(220, 38, 38, 0.1)'; this.style.color='#dc2626'">✕</button>
                                </div>
                                <div id="previewContent" style="color: #e5e7eb;"></div>
                                <div style="margin-top: 2.5rem; padding-top: 1.5rem; border-top: 2px solid rgba(220, 38, 38, 0.3); display: flex; gap: 1rem; justify-content: flex-end;">
                                    <button type="button" class="btn" onclick="closePreview()" style="background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.2); color: #fff; padding: 0.75rem 1.5rem; border-radius: 0.5rem; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='rgba(255, 255, 255, 0.1)'" onmouseout="this.style.background='rgba(255, 255, 255, 0.05)'">Close</button>
                                    <button type="button" class="btn" onclick="document.getElementById('pasteForm').submit();" style="background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%); border: 1px solid #dc2626; color: #fff; padding: 0.75rem 2rem; border-radius: 0.5rem; cursor: pointer; font-weight: 600; transition: all 0.2s; box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);" onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 6px 16px rgba(220, 38, 38, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(220, 38, 38, 0.3)'">✓ Confirm & Create</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </section>
    </div>

    <script>
        let setCounter = 0;
        let questionCounters = {};

        // Toggle between Manual and Paste modes
        document.getElementById('modeManual').addEventListener('change', function() {
            if (this.checked) {
                document.getElementById('manualMode').style.display = 'block';
                document.getElementById('pasteMode').style.display = 'none';
            }
        });

        document.getElementById('modePaste').addEventListener('change', function() {
            if (this.checked) {
                document.getElementById('manualMode').style.display = 'none';
                document.getElementById('pasteMode').style.display = 'block';
            }
        });

        // Preview function for paste mode
        function previewPaste() {
            const title = document.getElementById('pasteTitle').value;
            const description = document.getElementById('pasteDesc').value;
            const content = document.getElementById('pasteContent').value;

            if (!title || !content) {
                alert('Please fill in the title and content');
                return;
            }

            // Parse the content
            const lines = content.split('\n').map(line => line.trim()).filter(line => line);
            const preview = parseQuizPreview(lines);

            // Generate HTML preview
            let previewHTML = `
                <div style="margin-bottom: 2rem;">
                    <h3 style="margin: 0 0 0.5rem 0; color: #fff; font-size: 1.5rem;">${title}</h3>
                    <p style="margin: 0 0 2rem 0; color: #9ca3af;">Quiz will have <strong style="color: #dc2626;">${preview.totalQuestions}</strong> questions across <strong style="color: #dc2626;">${preview.sections.length}</strong> sections</p>
            `;

            if (description) {
                previewHTML += `<div style="margin-bottom: 2rem; padding: 1rem; background: rgba(220, 38, 38, 0.1); border-radius: 0.5rem; border-left: 3px solid #dc2626; color: #e5e7eb;">${description}</div>`;
            }

            preview.sections.forEach((section, idx) => {
                const sectionColor = section.type === 'multiple_choice' ? '#dc2626' : section.type === 'identification' ? '#f59e0b' : '#8b5cf6';
                previewHTML += `
                    <div style="margin-bottom: 2rem; padding: 1.5rem; background: rgba(0, 0, 0, 0.3); border: 2px solid ${sectionColor}; border-radius: 0.75rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);">
                        <h4 style="margin: 0 0 1rem 0; color: ${sectionColor}; font-size: 1.25rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">${section.title}</h4>
                        <p style="margin: 0 0 1rem 0; color: #9ca3af; font-size: 0.9rem;">${section.questions.length} questions</p>
                        <div style="max-height: 300px; overflow-y: auto; padding-right: 0.5rem;">
                `;

                section.questions.forEach((q, qIdx) => {
                    previewHTML += `
                        <div style="margin-bottom: 1rem; padding: 1rem; background: rgba(255, 255, 255, 0.02); border-radius: 0.5rem; border-left: 3px solid ${sectionColor}; border: 1px solid rgba(255, 255, 255, 0.1);">
                            <div style="font-weight: 600; margin-bottom: 0.5rem; color: #fff;">Q${q.number}: ${q.text.substring(0, 80)}${q.text.length > 80 ? '...' : ''}</div>
                    `;

                    if (section.type === 'multiple_choice' && q.answers) {
                        previewHTML += `<div style="color: #9ca3af; font-size: 0.85rem;">Choices: ${q.answers.length}, Correct: <span style="color: #10b981; font-weight: 600;">${q.correctAnswer || 'Not set'}</span></div>`;
                    } else if (section.type === 'identification' && q.answer) {
                        previewHTML += `<div style="color: #10b981; font-size: 0.85rem; font-weight: 600;">✓ Answer: ${q.answer}</div>`;
                    } else if (section.type === 'true_false' && q.answer) {
                        previewHTML += `<div style="color: ${q.answer === 'True' ? '#10b981' : '#ef4444'}; font-size: 0.85rem; font-weight: 600;">Answer: ${q.answer}</div>`;
                    } else {
                        previewHTML += `<div style="color: #f59e0b; font-size: 0.85rem;">⚠ Answer not found in answer key</div>`;
                    }

                    previewHTML += `</div>`;
                });

                previewHTML += `</div></div>`;
            });

            previewHTML += `</div>`;

            document.getElementById('previewContent').innerHTML = previewHTML;
            document.getElementById('previewModal').style.display = 'block';
        }

        function closePreview() {
            document.getElementById('previewModal').style.display = 'none';
        }

        function parseQuizPreview(lines) {
            const sections = [];
            let currentSection = null;
            let currentQuestion = null;
            let totalQuestions = 0;
            let inAnswerKey = false;
            const answerKey = { mc: {}, id: {}, tf: {} };

            // First pass: extract answer key
            let currentAnswerSection = null;
            lines.forEach((line, idx) => {
                if (line.includes('Answer Key') || line.includes('✅')) {
                    inAnswerKey = true;
                    return;
                }
                
                if (inAnswerKey) {
                    // Detect which section we're in
                    if (line.includes('Multiple Choice')) {
                        currentAnswerSection = 'mc';
                        return;
                    } else if (line.includes('Identification')) {
                        currentAnswerSection = 'id';
                        return;
                    } else if (line.includes('True/False') || line.includes('True or False')) {
                        currentAnswerSection = 'tf';
                        return;
                    }
                    
                    // Parse Multiple Choice answers: 1-B, 2-B, 3-D
                    if (line.match(/\d+-[A-Da-d]/)) {
                        const matches = line.matchAll(/(\d+)-([A-Da-d])/g);
                        for (const match of matches) {
                            answerKey.mc[parseInt(match[1])] = match[2].toLowerCase();
                        }
                    }
                    // Parse Identification: 31. Answer text
                    else if (line.match(/^\d+\.\s+/)) {
                        const match = line.match(/^(\d+)\.\s+(.+)/);
                        if (match) {
                            answerKey.id[parseInt(match[1])] = match[2].trim();
                        }
                    }
                    // Parse True/False: 41-True, 42-False
                    else if (line.match(/\d+-(True|False)/i)) {
                        const matches = line.matchAll(/(\d+)-(True|False)/gi);
                        for (const match of matches) {
                            answerKey.tf[parseInt(match[1])] = match[2];
                        }
                    }
                }
            });

            // Second pass: parse questions
            inAnswerKey = false;
            let questionNumber = 0;
            
            lines.forEach(line => {
                if (line.includes('Answer Key') || line.includes('✅')) {
                    // Save last question before entering answer key
                    if (currentQuestion && currentSection) {
                        if (currentSection.type === 'multiple_choice' && answerKey.mc[currentQuestion.number]) {
                            currentQuestion.correctAnswer = answerKey.mc[currentQuestion.number].toUpperCase();
                        } else if (currentSection.type === 'identification' && answerKey.id[currentQuestion.number]) {
                            currentQuestion.answer = answerKey.id[currentQuestion.number];
                        } else if (currentSection.type === 'true_false' && answerKey.tf[currentQuestion.number]) {
                            currentQuestion.answer = answerKey.tf[currentQuestion.number];
                        }
                    }
                    inAnswerKey = true;
                    if (currentSection) sections.push(currentSection);
                    return;
                }
                
                if (inAnswerKey) return;

                if (line.includes('PART I') || line.includes('PART 1') || line.includes('Multiple Choice')) {
                    // Save last question from previous section
                    if (currentQuestion && currentSection) {
                        if (currentSection.type === 'multiple_choice' && answerKey.mc[currentQuestion.number]) {
                            currentQuestion.correctAnswer = answerKey.mc[currentQuestion.number].toUpperCase();
                        } else if (currentSection.type === 'identification' && answerKey.id[currentQuestion.number]) {
                            currentQuestion.answer = answerKey.id[currentQuestion.number];
                        } else if (currentSection.type === 'true_false' && answerKey.tf[currentQuestion.number]) {
                            currentQuestion.answer = answerKey.tf[currentQuestion.number];
                        }
                    }
                    if (currentSection) sections.push(currentSection);
                    currentSection = { title: 'Multiple Choice', type: 'multiple_choice', questions: [] };
                    currentQuestion = null;
                    questionNumber = 0;
                } else if (line.includes('PART II') || line.includes('PART 2') || line.match(/Identification.*\(\d+\s+items\)/i)) {
                    // Save last question from previous section
                    if (currentQuestion && currentSection) {
                        currentSection.questions.push(currentQuestion);
                        if (currentSection.type === 'multiple_choice' && answerKey.mc[currentQuestion.number]) {
                            currentQuestion.correctAnswer = answerKey.mc[currentQuestion.number].toUpperCase();
                        } else if (currentSection.type === 'identification' && answerKey.id[currentQuestion.number]) {
                            currentQuestion.answer = answerKey.id[currentQuestion.number];
                        } else if (currentSection.type === 'true_false' && answerKey.tf[currentQuestion.number]) {
                            currentQuestion.answer = answerKey.tf[currentQuestion.number];
                        }
                    }
                    if (currentSection) sections.push(currentSection);
                    currentSection = { title: 'Identification', type: 'identification', questions: [] };
                    currentQuestion = null;
                    questionNumber = 30;
                } else if (line.includes('PART III') || line.includes('PART 3') || line.match(/True.*False.*\(\d+\s+items\)/i)) {
                    // Save last question from previous section
                    if (currentQuestion && currentSection) {
                        currentSection.questions.push(currentQuestion);
                        if (currentSection.type === 'multiple_choice' && answerKey.mc[currentQuestion.number]) {
                            currentQuestion.correctAnswer = answerKey.mc[currentQuestion.number].toUpperCase();
                        } else if (currentSection.type === 'identification' && answerKey.id[currentQuestion.number]) {
                            currentQuestion.answer = answerKey.id[currentQuestion.number];
                        } else if (currentSection.type === 'true_false' && answerKey.tf[currentQuestion.number]) {
                            currentQuestion.answer = answerKey.tf[currentQuestion.number];
                        }
                    }
                    if (currentSection) sections.push(currentSection);
                    currentSection = { title: 'True or False', type: 'true_false', questions: [] };
                    currentQuestion = null;
                    questionNumber = 40;
                } else if (currentSection && line && !line.match(/^(Instruction|Write|Choose|correct|term)/i)) {
                    // Check if it's an answer option
                    if (/^[a-d]\)\s+/i.test(line) && currentSection.type === 'multiple_choice') {
                        if (currentQuestion) {
                            if (!currentQuestion.answers) currentQuestion.answers = [];
                            currentQuestion.answers.push(line.substring(3).trim());
                        }
                    } else if (/^(True|False)$/i.test(line) && currentSection.type === 'true_false') {
                        // Skip standalone True/False options
                    } else if (line.trim().length > 0 && !line.match(/^\d+\s+items/i)) {
                        // It's a new question - save previous question first
                        if (currentQuestion && currentSection) {
                            currentSection.questions.push(currentQuestion);
                            if (currentSection.type === 'multiple_choice' && answerKey.mc[currentQuestion.number]) {
                                currentQuestion.correctAnswer = answerKey.mc[currentQuestion.number].toUpperCase();
                            } else if (currentSection.type === 'identification' && answerKey.id[currentQuestion.number]) {
                                currentQuestion.answer = answerKey.id[currentQuestion.number];
                            } else if (currentSection.type === 'true_false' && answerKey.tf[currentQuestion.number]) {
                                currentQuestion.answer = answerKey.tf[currentQuestion.number];
                            }
                        }
                        
                        questionNumber++;
                        totalQuestions++;
                        currentQuestion = { 
                            number: questionNumber, 
                            text: line, 
                            answers: [], 
                            answer: null,
                            correctAnswer: null
                        };
                    }
                }
            });

            // Set answer for last question and push to section
            if (currentQuestion && currentSection) {
                currentSection.questions.push(currentQuestion);
                if (currentSection.type === 'multiple_choice' && answerKey.mc[currentQuestion.number]) {
                    currentQuestion.correctAnswer = answerKey.mc[currentQuestion.number].toUpperCase();
                } else if (currentSection.type === 'identification' && answerKey.id[currentQuestion.number]) {
                    currentQuestion.answer = answerKey.id[currentQuestion.number];
                } else if (currentSection.type === 'true_false' && answerKey.tf[currentQuestion.number]) {
                    currentQuestion.answer = answerKey.tf[currentQuestion.number];
                }
            }

            if (currentSection) sections.push(currentSection);

            return { sections, totalQuestions };
        }

        // Close modal when clicking outside
        document.getElementById('previewModal')?.addEventListener('click', (e) => {
            if (e.target.id === 'previewModal') closePreview();
        });


        function addSet(type = 'multiple_choice') {
            setCounter++;
            questionCounters[setCounter] = 0;
            
            const setHtml = `
                <div class="builder-set" id="set-${setCounter}" data-reveal data-delay="140">
                    <div class="builder-header">
                        <div>
                            <div class="page-title" style="font-size: 1.1rem;">Set ${setCounter}</div>
                            <div class="faint">Configure the question type</div>
                        </div>
                        <button type="button" class="btn btn-ghost" onclick="removeSet(${setCounter})">Remove</button>
                    </div>

                    <div class="form-group">
                        <label>Question Type</label>
                        <select name="sets[${setCounter - 1}][type]" class="select" onchange="updateSetType(${setCounter})" required>
                            <option value="multiple_choice">Multiple Choice</option>
                            <option value="identification">Identification</option>
                        </select>
                    </div>

                    <div id="questions-${setCounter}" class="stack"></div>

                    <button type="button" class="btn btn-outline" onclick="addQuestion(${setCounter})">+ Add Question</button>
                </div>
            `;
            
            document.getElementById('setsContainer').insertAdjacentHTML('beforeend', setHtml);

            const newSet = document.getElementById(`set-${setCounter}`);
            if (newSet) {
                requestAnimationFrame(() => newSet.classList.add('revealed'));
            }

            const setIndex = setCounter - 1;
            const select = document.querySelector(`select[name="sets[${setIndex}][type]"]`);
            if (select) select.value = type;

            addQuestion(setCounter);
        }

        function removeSet(setId) {
            document.getElementById(`set-${setId}`).remove();
        }

        function addQuestion(setId, data = null) {
            const questionNum = questionCounters[setId]++;
            const setIndex = setId - 1;
            const typeSelect = document.querySelector(`select[name="sets[${setIndex}][type]"]`);
            const type = typeSelect ? typeSelect.value : 'multiple_choice';
            
            let questionHtml = `
                <div class="card" id="question-${setId}-${questionNum}">
                    <div class="builder-header">
                        <div>
                            <div class="page-title" style="font-size: 1rem;">Question ${questionNum + 1}</div>
                            <div class="faint">Add the prompt and answer</div>
                        </div>
                        <button type="button" class="btn btn-ghost" onclick="removeQuestion(${setId}, ${questionNum})">Remove</button>
                    </div>
                    <div class="form-group">
                        <label>Question</label>
                        <input type="text" name="sets[${setIndex}][questions][${questionNum}][question]" class="input" placeholder="Enter question" required>
                    </div>
            `;

            if (type === 'multiple_choice') {
                questionHtml += `
                    <div class="form-group">
                        <label>Choices (check the correct answer)</label>
                        <div class="choice-row">
                            <input type="checkbox" class="choice-check" data-set="${setId}" data-q="${questionNum}" value="0" required>
                            <input type="text" name="sets[${setIndex}][questions][${questionNum}][choices][]" class="input" placeholder="Choice 1" required>
                        </div>
                        <div class="choice-row">
                            <input type="checkbox" class="choice-check" data-set="${setId}" data-q="${questionNum}" value="1" required>
                            <input type="text" name="sets[${setIndex}][questions][${questionNum}][choices][]" class="input" placeholder="Choice 2" required>
                        </div>
                        <div class="choice-row">
                            <input type="checkbox" class="choice-check" data-set="${setId}" data-q="${questionNum}" value="2" required>
                            <input type="text" name="sets[${setIndex}][questions][${questionNum}][choices][]" class="input" placeholder="Choice 3" required>
                        </div>
                        <div class="choice-row">
                            <input type="checkbox" class="choice-check" data-set="${setId}" data-q="${questionNum}" value="3" required>
                            <input type="text" name="sets[${setIndex}][questions][${questionNum}][choices][]" class="input" placeholder="Choice 4" required>
                        </div>
                    </div>
                `;
            } else {
                questionHtml += `
                    <div class="form-group">
                        <label>Correct Answer</label>
                        <input type="text" name="sets[${setIndex}][questions][${questionNum}][correct_answer]" class="input" placeholder="Enter correct answer" required>
                    </div>
                `;
            }

            questionHtml += `
                </div>
            `;
            
            const questionsContainer = document.getElementById(`questions-${setId}`);
            questionsContainer.insertAdjacentHTML('beforeend', questionHtml);

            const newQuestion = questionsContainer.querySelector(`#question-${setId}-${questionNum}`);
            if (newQuestion && type === 'multiple_choice') {
                const checks = Array.from(newQuestion.querySelectorAll('.choice-check'));
                checks.forEach(check => {
                    check.addEventListener('change', () => {
                        if (check.checked) {
                            checks.forEach(other => {
                                if (other !== check) other.checked = false;
                            });
                        }
                    });
                });
            }

            if (newQuestion && data) {
                const questionInput = newQuestion.querySelector('input[name*="[question]"]');
                if (questionInput) questionInput.value = data.question || '';

                if (type === 'multiple_choice') {
                    const choiceInputs = newQuestion.querySelectorAll('input[name*="[choices]"]');
                    (data.choices || []).forEach((choice, index) => {
                        if (choiceInputs[index]) choiceInputs[index].value = choice;
                    });

                    const checks = newQuestion.querySelectorAll('.choice-check');
                    if (typeof data.correctChoice === 'number' && checks[data.correctChoice]) {
                        checks[data.correctChoice].checked = true;
                    }
                } else {
                    const answerInput = newQuestion.querySelector('input[name*="[correct_answer]"]');
                    if (answerInput) answerInput.value = data.correctAnswer || '';
                }
            }
        }

        function removeQuestion(setId, questionNum) {
            document.getElementById(`question-${setId}-${questionNum}`).remove();
        }

        function updateSetType(setId) {
            const questionsContainer = document.getElementById(`questions-${setId}`);
            questionsContainer.innerHTML = '';
            questionCounters[setId] = 0;
            addQuestion(setId);
        }

        window.addEventListener('DOMContentLoaded', () => {
            addSet();
        });
    </script>

    <style>
        .builder-set {
            padding: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 0.75rem;
            background: rgba(255, 255, 255, 0.05);
            margin-bottom: 1.5rem;
        }

        .builder-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .choice-row {
            display: flex;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
            align-items: center;
        }

        .choice-row input[type="checkbox"] {
            flex-shrink: 0;
            margin-top: 0.25rem;
        }

        .choice-row input[type="text"] {
            flex: 1;
        }
    </style>
</body>
</html>
