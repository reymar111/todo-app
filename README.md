# Laravel GraphQL To-Do App

## A simple implementation of Laravel, GraphQL, and Nuxt JS Todo App

## Setup

1. Clone the repository
2. CD to root directory and Run `composer install`
3. Copy `.env.example` to `.env` and configure your environment variables
4. Run `php artisan migrate` to migrate database tables
5. Run `php artisan serve` to start Laravel Server
6. CD to client directory
7. Run `npm install` and `npm run dev` to start Nuxt server
8. Access the application at `http://localhost:3000`

## Endpoints

- POST `/api/register` - Register a new user
- POST `/api/login` - Login
- POST `/api/logout` - Logout
- GraphQL Endpoint - `/graphql`
- GraphQL Playground - `http://127.0.0.1:8000/graphiql`