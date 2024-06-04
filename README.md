# LMS

# Learning Management System (LMS) - Laravel Project

This project is a Learning Management System (LMS) developed using Laravel. It allows users to manage courses, lessons, and enrollments. The system includes role-based access control, with admin users having additional privileges for managing courses and lessons.

## Setup Instructions

### Prerequisites

- PHP >= “^8.1”
- Composer
- MySQL

### Installation

1. Clone the repository:
    
    ```bash
    git clone https://github.com/ahmedgalal2001/Learning-Management-System
    ```
    
2. Navigate to the project directory:
    
    ```bash
    cd Learning-Management-System
    ```
    
3. Install dependencies:
    
    ```
    composer install
    ```
    
4. Copy the `.env.example` file to `.env`:
    
    ```bash
    copy .env.example .env
    ```
    
5. Generate Application Key:

```tsx
php artisan key:generate
```

1. Install Vite:

```tsx
npm install vite@latest
```

1. Migrate the database:
    
    ```
    php artisan migrate
    ```
    
2. Seed the database with dummy data (optional): 
- this will create 10 courses and 10 user and one admin
- admin⇒  email:“[ahmedgalal@iti.com](mailto:ahmedgalal@iti.com)” , password:”OSALEX123”

```
php artisan db:seed
```

### Running the Application

To run the Laravel development server, execute the following command:

```
php artisan serve
```

The application will be accessible at `http://localhost:8000`.

### Running Tests

To run PHPUnit tests, use the following command:

```bash
php artisan test
```

This will execute all the feature tests defined in the `tests/Feature` directory.

## Usage

- Register a new account or login if you already have one.
- Admin users can manage courses and lessons from the admin dashboard.
- Regular users can enroll in courses, view enrolled courses, and access lessons.
