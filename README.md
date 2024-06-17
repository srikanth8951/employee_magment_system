# Laravel Vue.js Project

This project is a web application built with Laravel, Vue.js, Tailwind CSS, Axios, Pinia, PrimeVue, and Vue Router. It provides functionalities to manage employees and their skills.

## Prerequisites

-   PHP >= 8.0
-   Composer
-   Node.js >= 14.x
-   npm or Yarn

## Installation

### Backend (Laravel)

1. **Clone the repository**:

    ```bash
    git clone https://github.com/your-repository.git
    cd your-repository
    ```

2. **Install PHP dependencies**:

    ```bash
    composer install
    ```

3. **Set up your `.env` file**:

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
4. **Configure your database**:
   Update your `.env` file with your database credentials.

5. **Run migrations**:
    ```bash
    php artisan migrate
    ```

### Compile Assets

1. **Compile assets for development**:

    ```bash
    npm run dev
    ```

2. **Compile assets for production**:
    ```bash
    npm run production
    ```

## Usage

1. **Start the Laravel development server**:

    ```bash
    php artisan serve
    ```

2. **Access the application**:
   Open your browser and navigate to `http://localhost:8000`.
