# Employee management panel

## Installation

1. Build Docker containers
```
 docker-compose up -d --build
```

2. Create the .env file
```
 docker-compose exec emp_php cp .env.example .env  
```

3. Install the dependencies
```
 docker-compose exec emp_php composer install
```

4. Generate an app key
```
 docker-compose exec emp_php php artisan key:generate
```

5. Migrate the database
```
 docker-compose exec emp_php php artisan migrate
```

Now you can access the server at http://localhost:8080/
