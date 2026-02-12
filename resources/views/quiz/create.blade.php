<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Quiz</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="navbar">
        <div class="navbar-content">
            <a href="{{ route('quiz.index') }}" class="navbar-brand">🎯 QuizMaster</a>
            <div class="navbar-nav">
                <a href="{{ route('quiz.index') }}" class="nav-link">← Back to Quizzes</a>
            </div>
        </div>
    </div>

    <div class="container-narrow">
        <div class="card fade-in">
            <h1 style="color: var(--dark); text-shadow: none;">✨ Create New Quiz</h1>
            
            <form id="quizForm" method="POST" action="{{ route('quiz.store') }}">
                @csrf
                
                <div class="form-group">
                    <label for="title">Quiz Title</label>
                    <input type="text" id="title" name="title" class="text-input" placeholder="Enter quiz title" required>
                </div>

                <div id="setsContainer">
                    <!-- Sets will be added here dynamically -->
                </div>

                <button type="button" class="btn btn-secondary" onclick="addSet()">+ Add Set</button>
                <div class="actions">
                    <a href="{{ route('quiz.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-submit">Create Quiz 🚀</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let setCounter = 0;
        let questionCounters = {};

        function addSet() {
            setCounter++;
            questionCounters[setCounter] = 0;
            
            const setHtml = `
                <div class="quiz-set fade-in" id="set-${setCounter}">
                    <div class="set-header">
                        <h2>📑 Set ${setCounter}</h2>
                        <button type="button" class="btn-remove" onclick="removeSet(${setCounter})">Remove Set</button>
                    </div>
                    
                    <div class="form-group">
                        <label>Question Type</label>
                        <select name="sets[${setCounter - 1}][type]" class="text-input" onchange="updateSetType(${setCounter}, this.value)" required>
                            <option value="multiple_choice">Multiple Choice</option>
                            <option value="identification">Identification</option>
                        </select>
                    </div>

                    <div id="questions-${setCounter}">
                        <!-- Questions will be added here -->
                    </div>

                    <button type="button" class="btn btn-small" onclick="addQuestion(${setCounter})">+ Add Question</button>
                </div>
            `;
            
            document.getElementById('setsContainer').insertAdjacentHTML('beforeend', setHtml);
            addQuestion(setCounter);
        }

        function removeSet(setId) {
            document.getElementById(`set-${setId}`).remove();
        }

        function addQuestion(setId) {
            const questionNum = questionCounters[setId]++;
            const setIndex = setId - 1;
            const type = document.querySelector(`select[name="sets[${setIndex}][type]"]`).value;
            
            let questionHtml = `
                <div class="question-block fade-in" id="question-${setId}-${questionNum}">
                    <div class="question-header">
                        <label>❓ Question ${questionNum + 1}</label>
                        <button type="button" class="btn-remove-small" onclick="removeQuestion(${setId}, ${questionNum})">×</button>
                    </div>
                    <input type="text" name="sets[${setIndex}][questions][${questionNum}][question]" 
                           class="text-input" placeholder="Enter question" required>
            `;

            if (type === 'multiple_choice') {
                questionHtml += `
                    <label>Choices</label>
                    <input type="text" name="sets[${setIndex}][questions][${questionNum}][choices][]" 
                           class="text-input" placeholder="Choice 1" required>
                    <input type="text" name="sets[${setIndex}][questions][${questionNum}][choices][]" 
                           class="text-input" placeholder="Choice 2" required>
                    <input type="text" name="sets[${setIndex}][questions][${questionNum}][choices][]" 
                           class="text-input" placeholder="Choice 3" required>
                    <input type="text" name="sets[${setIndex}][questions][${questionNum}][choices][]" 
                           class="text-input" placeholder="Choice 4" required>
                `;
            }

            questionHtml += `
                    <label>Correct Answer</label>
                    <input type="text" name="sets[${setIndex}][questions][${questionNum}][correct_answer]" 
                           class="text-input" placeholder="Enter correct answer" required>
                </div>
            `;
            
            document.getElementById(`questions-${setId}`).insertAdjacentHTML('beforeend', questionHtml);
        }

        function removeQuestion(setId, questionNum) {
            document.getElementById(`question-${setId}-${questionNum}`).remove();
        }

        function updateSetType(setId, type) {
            const questionsContainer = document.getElementById(`questions-${setId}`);
            questionsContainer.innerHTML = '';
            questionCounters[setId] = 0;
            addQuestion(setId);
        }

        // Add first set on load
        window.addEventListener('DOMContentLoaded', () => {
            addSet();
        });
    </script>
</body>
</html>
