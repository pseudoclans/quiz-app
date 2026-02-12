# Quick Start Guide

## Option 1: Using the Start Script (Windows)

Simply double-click `start.bat` to launch both the Laravel server and Vite dev server automatically.

## Option 2: Manual Start

Open two terminal windows:

**Terminal 1 - Laravel Server:**
```bash
cd quiz-app
php artisan serve
```

**Terminal 2 - Vite Dev Server:**
```bash
cd quiz-app
npm run dev
```

Then visit: http://localhost:8000

## Creating Your First Quiz

1. Click the "Create New Quiz" button
2. Enter a quiz title (e.g., "My First Quiz")
3. Click "Add Set" to create a question set
4. Choose the question type:
   - **Multiple Choice**: For questions with 4 options
   - **Identification**: For open-ended text answers
5. Click "Add Question" to add questions to the set
6. Fill in:
   - Question text
   - Choices (for multiple choice)
   - Correct answer
7. Add more sets or questions as needed
8. Click "Create Quiz" to save

## Managing Quizzes

### Edit a Quiz
- Click "Edit" on any quiz card
- Modify questions, answers, or title
- Click "Update Quiz"

### Delete a Quiz
- Click "Delete" on any quiz card
- Confirm deletion

### Take a Quiz
- Click "Start Quiz" on any quiz card
- Answer all questions
- Click "Submit Quiz" to see results

## Features

✅ Create quizzes through web interface
✅ Multiple choice questions with 4 options
✅ Identification/text input questions
✅ Mix different question types in one quiz
✅ Edit existing quizzes
✅ Delete quizzes
✅ Instant scoring and feedback
✅ Beautiful gradient UI
✅ Smooth animations
✅ Responsive design

## Tips

- You can have unlimited sets per quiz
- Each set can have unlimited questions
- Mix multiple choice and identification sets in one quiz
- Answers for identification questions are case-insensitive
- All data is automatically saved to JSON
