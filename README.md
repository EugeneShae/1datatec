# Submission API

This Laravel API demonstrates proficiency with Laravel's job queues, database operations, migrations, and event handling.

## Table of Contents
- [Installation](#installation)
- [Usage](#usage)
    - [Testing the API](#testing-the-api)
    - [Running Tests](#running-tests)
- [Project Structure](#project-structure)
- [Error Handling](#error-handling)
    - [Invalid Data Input](#invalid-data-input)
    - [Errors During Job Processing](#errors-during-job-processing)

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/EugeneShae/1datatec.git submission-api
   ```

2. Install dependencies:
   ```bash
   composer install
   ```

3. Copy the `.env.example` file to `.env` and configure your database settings:
   ```bash
   cp .env.example .env
   ```

4. Generate an application key:
   ```bash
   php artisan key:generate
   ```

5. Run migrations:
   ```bash
   php artisan migrate
   ```

6. Start the development server:
   ```bash
   php artisan serve
   ```

7. In a separate terminal, start the queue worker:
   ```bash
   php artisan queue:work
   ```

## Usage

### Testing the API

You can test the API using curl or any API testing tool like Postman. Here's an example using curl:

```bash
curl -X POST http://localhost:8000/api/submit \
     -H "Content-Type: application/json" \
     -d '{"name": "John Doe", "email": "john.doe@example.com", "message": "This is a test message."}'
```

You should receive a 202 Accepted response with a message indicating that the submission was queued for processing.

### Running Tests

To run the unit and feature tests, use the following command:

```bash
php artisan test
```

This will run all the tests in the `tests` directory, including the `SubmissionTest` and `ProcessSubmissionTest`.

## Project Structure

The project structure follows the standard Laravel convention:

```
submission-api/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── SubmissionController.php
│   │   ├── Contracts/
│   │   │   └── SubmissionRequestInterface.php
│   │   └── Requests/
│   │       └── SubmissionRequest.php
│   │ 
│   ├── Jobs/
│   │   └── ProcessSubmission.php
│   ├── Events/
│   │   └── SubmissionSaved.php
│   ├── Listeners/
│   │   └── LogSubmissionSaved.php
│   └── Models/
│       └── Submission.php
│
├── bootstrap/
│
├── config/
│
├── database/
│   └── migrations/
│       └── yyyy_mm_dd_hhmmss_create_submissions_table.php
│
├── public/
│
├── resources/
│
├── routes/
│   └── api.php
├── tests/
│   └── Feature/
│       └── SubmissionTest.php
│
├── .env.example
├── .gitignore
├── composer.json
└── README.md
```

## Error Handling

The API implements error handling for two scenarios:

### Invalid Data Input

If any of the required fields (`name`, `email`, or `message`) are missing or invalid, the API will respond with a 422 Unprocessable Entity status code and provide the validation errors in the response.

### Errors During Job Processing

If any exceptions occur during the job processing (e.g., database connection issues), the API will respond with a 500 Internal Server Error status code and a generic error message. The actual error details will be logged for troubleshooting purposes.
