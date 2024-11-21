# Comment System

## Installation
1. Clone the repository.
2. Run `composer install`.
3. Set up your `.env` file for database credentials.
4. Run `php artisan migrate` to create the tables.

## Features
- Multi-level comments with a depth limit of 3 levels.
- Comments are hierarchical and replies are displayed under each comment.
- Scheduled command to delete comments with empty content.

## Running the Scheduler
Run the following to trigger the scheduler:
```bash
php artisan schedule:run
-uses livewire
