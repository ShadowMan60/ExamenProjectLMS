# NeoTsangExamenProject - Quiz Application

## Project Overview
This project is a quiz application built with Laravel 11. It provides REST API endpoints for fetching quiz questions and submitting quiz results. The application includes unit, feature, and end-to-end tests to ensure quality.

---

## User Stories / Functionalities Implemented
- As a user, I can fetch quiz questions via the API endpoint: `/api/questions`.
- As a user, I can submit my quiz answers via the API endpoint: `/api/results` and receive results.
- End-to-end testing verifies the entire user flow using Laravel Dusk and ChromeDriver.
- Unit and feature tests ensure backend logic and API routes work correctly.

---

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/NeoTsangExamenProject.git
   cd NeoTsangExamenProject/Examen
Install dependencies:

bash
Copy
Edit
composer install
Copy .env.example to .env and configure your database settings.

Generate application key:

bash
Copy
Edit
php artisan key:generate
Run migrations and seeders:

bash
Copy
Edit
php artisan migrate --seed
Make sure ChromeDriver is installed and running on port 9515 (for Laravel Dusk tests).

Testing
Unit and Feature Tests
Run tests with PHPUnit or Pest:

bash
Copy
Edit
vendor/bin/phpunit
# or
vendor/bin/pest
End-to-End Tests with Laravel Dusk
Ensure ChromeDriver is running:

Download ChromeDriver matching your Chrome version.

Run ChromeDriver manually (e.g., chromedriver.exe --port=9515).

Run Dusk tests:

bash
Copy
Edit
php artisan dusk
API Endpoints
GET /api/questions
Returns a list of quiz questions.

Example response:

json
Copy
Edit
[
  {
    "id": 1,
    "question": "What is 2+2?",
    "options": ["3", "4", "5", "6"]
  },
  ...
]
POST /api/results
Submits answers and returns the result score.

Request body example:

json
Copy
Edit
{
  "answers": {
    "1": "4",
    "2": "true",
    ...
  }
}
Response example:

json
Copy
Edit
{
  "score": 8,
  "total": 10
}
Version Control
All development versions, commits, and test stages are tracked in the GitHub repository at:
https://github.com/yourusername/NeoTsangExamenProject

Commit messages are clear and indicate the feature or fix implemented, e.g.:

feat(api): add questions endpoint

test(dusk): add basic end-to-end quiz test

fix(api): correct result calculation bug

Database Schema
questions table: stores quiz questions and options.

results table: stores user quiz attempts and scores.

Migrations and seeders are located in the /database/migrations and /database/seeders directories.

Planning & Collaboration
The project was developed over X weeks following the assigned user stories.

Version control through GitHub was used for collaboration and code review.

Regular commits and branch management ensured clean integration.

Contact
For any questions, contact Neo Tsang at [your email].