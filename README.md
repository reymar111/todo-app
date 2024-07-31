# Laravel GraphQL To-Do App

## Setup

1. Clone the repository
2. Copy `.env.example` to `.env` and configure your environment variables
3. Run `docker-compose up --build` to start the containers
4. Run `docker-compose exec app php artisan migrate` to run the migrations
5. Access the application at `http://localhost:9000`

## Endpoints

- POST `/api/register` - Register a new user
- POST `/api/login` - Login
- POST `/api/logout` - Logout
- GraphQL Endpoint - `/graphql`

## Docker Commands

- `docker-compose up --build` - Build and start the containers
- `docker-compose exec app php artisan migrate` - Run migrations
