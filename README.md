# Laravel Blog Application

This repository houses a fully functional Laravel blog application designed for seamless content creation and management.

## Features

* **CRUD Operations:** Effortlessly create, read, update, and delete blog posts.
* **User Authentication:** Securely manage user accounts and access levels with built-in authentication. 

## Getting Started

1. **Clone the repository:**
```
git clone https://github.com/vikashksingh58/blog-app.git
```

2. **Navigate to the project directory:**
```
cd blog-app
```

3. **Install dependencies::**
```
composer install
```
```
npm install
```

4. **Configure environment variables::**
   - Rename .env.example to .env
   - Update database credentials and any other relevant settings within the .env file.

5. **Generate application key:::**
   ```
   php artisan key:generate
   ```
    
6. **Run database migrations:::**
   ```
   php artisan migrate
   ```
7. **Run database seeder:::**
   ```
   php artisan db:seed
   ```   
8. **Start the development server:::**
   ```
   php artisan serve
   ```
9. **Storage link :::**
   ```
   php artisan storage:link
   ```
10. **Access the application:::**
   - Open your web browser and visit http://127.0.0.1:8000 to explore the blog application.
 
    - Admin credential is
    User email - 
    ```
    admin@example.com
    ```
    password - 
    ```
    123456789
    ```
    - Users credentials are 
    User email -
    ```
    userone@example.com and usertwo@example.com
    ```
    password - 
    ```
    123456789
    ```
