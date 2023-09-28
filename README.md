## Apps: To-Do

An application to manage To-Do tasks with categories and much more. Something like Trello, just for practicing.

The same core will be available in many languages/frameworks and can be consumed by many interfaces between web and mobile platforms.

Features:
- Manage categories: done!
- Manage tasks: soon!
- User registration: soon!
- Dashboard: soon!

### Backend

- PHP/Laravel:
  1. Clone the repository
  2. Navigate to ```/backend/laravel``` folder
  3. Execute command: ```composer install```
  4. Configure ```.env``` file to connect to your database
  5. Execute command: ```php artisan migrate``` *(use "migrate:fresh" to drop tables and migrate again)*
  6. Execute command: ```php artisan serve```

- JavaScript/Express: soon!

- TypeScript/Nest: soon!

- Python/Django: soon!

All REST APIs will have these endpoints:

| Method | Route | Status codes | Description |
| - | - | - | - |
| GET | ```/api/categories``` | 200 | list all categories with pagination
| GET | ```/api/categories/1``` | 200, 404 | show category with id 1
| POST | ```/api/categories``` |  201, 422 | create category with following data:<br />- ```title```: string, required, 1 to 25 characters<br />- ```description```: text, not required<br />- ```color```: string, required, hex color (like ```#0369AF```)
| PUT | ```/api/categories/1``` | 200, 404, 422 | update category with id 1 and with same data from ```POST``` method
| DELETE | ```/api/categories/1``` | 200*, 404 | delete category with id 1

*\* Should be 204, but I tried to keep the same content in response for all requests as below.*

The response is always the same:

- Example of success:
    ```
    {
        data: <object or array of objects>,
        error: null,
    }
    ```

- Example of error:
    ```
    {
        data: null,
        error: <array of errors, even if there is only one>,
    }
    ```

### Frontend

- JavaScript/jQuery: soon!

- JavaScript/Vue: soon!

- TypeScript/Angular: soon!

### Mobile

- Android/Kotlin: soon!

- iOS/Swift: soon!
