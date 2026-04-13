## Description

This service is designed for user registration and image processing.

## Technologies

- Infrastructure: PHP, PostgreSQL, RabbitMQ
- Framework: Symfony
- Code analysis: PHPStan, PHPCS

## Setup Instructions

Clone the project from the git repository:
```bash
ssh://git@github.com:ubunvova/otus-course-project.git
```

Create `.env` from `.env.template` in the root folder and fill in your credentials.

To start, run `make start` and `make migrate` in the root of the project.

## Useful Commands

### Running consumers:
1. Consumer for the image-processing topic
    ```bash
    php bin/console app:image-processing:consume
    ```
