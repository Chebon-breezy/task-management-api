# Task Management API

A RESTful API built with Lumen for managing tasks. This API provides CRUD operations for tasks with additional features like filtering, searching, and pagination.

## Features

-   Create, Read, Update, and Delete tasks
-   Filter tasks by status and due date
-   Search tasks by title
-   Pagination support
-   Data validation
-   Error handling

## Requirements

-   PHP >= 7.4
-   PostgreSQL >= 12
-   Composer

## Installation

1. Clone the repository:

```bash
git clone https://github.com/Chebon-breezy/task-management-api.git
cd task-management-api
```

2. Install dependencies:

```bash
composer install
```

3. Configure environment:

```bash
cp .env.example .env
# Update database credentials in .env file
```

4. Create database:

```bash
createdb task_management
```

5. Run migrations:

```bash
php artisan migrate
```

## API Endpoints

### Get All Tasks

```
GET /api/tasks
```

Query Parameters:

-   `status`: Filter by status (pending/completed)
-   `due_date`: Filter by due date (YYYY-MM-DD)
-   `search`: Search by title
-   `page`: Page number for pagination
-   `per_page`: Items per page

### Create Task

```
POST /api/tasks
```

Request Body:

```json
{
    "title": "Task Title",
    "description": "Task Description",
    "status": "pending",
    "due_date": "2024-05-01"
}
```

### Get Single Task

```
GET /api/tasks/{id}
```

### Update Task

```
PUT /api/tasks/{id}
```

Request Body: Same as Create Task

### Delete Task

```
DELETE /api/tasks/{id}
```

## Testing

Run the test suite:

```bash
./vendor/bin/phpunit
```

## Development Server

Start the development server:

```bash
php -S localhost:8000 -t public
```
