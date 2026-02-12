# Laravel Quiz Application - Professional Edition

A stunning, modern quiz application built with Laravel and Vite featuring a professional design with dynamic question creation, smooth animations, and an outstanding user experience.

## ✨ Features

- **Beautiful Professional Design** - Modern UI with gradient backgrounds, smooth animations, and polished components
- **Create Quizzes Dynamically** - Intuitive web interface for building quizzes
- **Edit Existing Quizzes** - Modify quiz content anytime
- **Delete Quizzes** - Remove quizzes with confirmation
- **Multiple Question Types**:
  - Multiple Choice questions with 4 options
  - Identification/Enumeration questions
- **Smart Navigation** - Sticky navbar with quick access
- **Real-time Scoring** - Instant feedback with animated score cards
- **Responsive Design** - Works perfectly on all devices
- **Smooth Animations** - Fade-in effects and hover transitions
- **JSON Storage** - Lightweight data persistence

## Installation

1. Install dependencies:
```bash
composer install
npm install
```

2. The .env file is already configured with SQLite database

3. Run migrations (already done during setup):
```bash
php artisan migrate
```

## Running the Application

1. Start the Laravel development server:
```bash
php artisan serve
```

2. In a separate terminal, start Vite for asset compilation:
```bash
npm run dev
```

3. Open your browser and visit: `http://localhost:8000`

## How to Use

### Creating a Quiz

1. Click "Create New Quiz" button on the home page
2. Enter a quiz title
3. Add sets (each set can be Multiple Choice or Identification type)
4. For each set, add questions:
   - **Multiple Choice**: Enter question, 4 choices, and the correct answer
   - **Identification**: Enter question and the correct answer
5. Click "Create Quiz" to save

### Taking a Quiz

1. From the home page, click "Start Quiz" on any quiz
2. Answer all questions in each set
3. Click "Submit Quiz" to see your results

### Editing a Quiz

1. Click "Edit" button on any quiz card
2. Modify the title, questions, or answers
3. Click "Update Quiz" to save changes

### Deleting a Quiz

1. Click "Delete" button on any quiz card
2. Confirm the deletion

## Routes

- `/` - List all available quizzes
- `/quiz/create` - Create a new quiz
- `/quiz/{id}` - Take a specific quiz
- `/quiz/{id}/edit` - Edit a quiz
- `/quiz/{id}/submit` - Submit quiz answers and view results

```json
{
  "quizzes": [
    {
      "id": 1,
      "title": "Quiz Title",
      "sets": [
        {
          "set_number": 1,
          "type": "multiple_choice",
          "questions": [
            {
              "id": 1,
              "question": "Your question here?",
              "choices": ["Option A", "Option B", "Option C", "Option D"],
              "correct_answer": "Option A"
            }
          ]
        },
        {
          "set_number": 2,
          "type": "identification",
          "questions": [
            {
              "id": 2,
              "question": "Your question here?",
              "correct_answer": "Correct Answer"
            }
          ]
        }
      ]
    }
  ]
}
```

## Question Types

- **multiple_choice**: Questions with predefined choices (radio buttons)
- **identification**: Open-ended text input questions

## Routes

- `/` - List all available quizzes
- `/quiz/create` - Create a new quiz
- `/quiz/{id}` - Take a specific quiz
- `/quiz/{id}/edit` - Edit a quiz
- `/quiz/{id}/submit` - Submit quiz answers and view results

## Design Highlights

- **Modern Color Palette** - Indigo and purple gradients with professional accents
- **Inter Font Family** - Clean, modern typography
- **Card-Based Layout** - Elevated cards with shadows and hover effects
- **Smooth Transitions** - All interactions feel polished and responsive
- **Visual Feedback** - Color-coded results, badges, and status indicators
- **Accessibility** - High contrast, clear labels, and keyboard navigation
- **Mobile-First** - Fully responsive across all screen sizes

## Technologies Used

- Laravel 12
- Vite for asset bundling
- Custom CSS with CSS Variables
- Vanilla JavaScript for interactivity
- SQLite database
- Inter font from Google Fonts
