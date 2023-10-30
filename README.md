## Apps: To-Do

An application to manage To-Do tasks with categories and much more. Something like Trello, just for practicing.

The same core will be available in many languages/frameworks and can be consumed by many interfaces between web and mobile platforms.

Features:
- Manage categories
- Manage task
- User registration
- Dashboard

Some details:
- If a category is deleted, all tasks from that category will be set to null, so these tasks will be with no category.
- If start date (and time) happens after end date (and time), the core will accept it as correct and will automatically invert these dates.

### Backend

- PHP/Laravel:
  1. Clone the repository
  2. Navigate to ```/backend/laravel``` folder
  3. Execute command: ```composer install```
  4. Configure ```.env``` file to connect to your database
  5. Execute command: ```php artisan key:generate```
  6. Execute command: ```php artisan jwt:secret```
  7. Execute command: ```php artisan migrate``` *(use ```migrate:fresh``` to drop tables and migrate again)*
  8. Execute command: ```php artisan serve```

- JavaScript/Express: soon!

- TypeScript/Nest: soon!

- Python/Django: soon!

All REST APIs will have these endpoints:

| Method | Route | Status codes | Description |
| - | - | - | - |
| GET | ```/api/categories``` | 200 | list all categories with pagination
| GET | ```/api/categories/1``` | 200, 404 | show category with id 1
| POST | ```/api/categories``` |  201, 422 | create category with following data:<br />- ```title```: required, up to 25 characters<br />- ```description```: not required<br />- ```color```: required, hex color (like ```#0369AF```)
| PUT | ```/api/categories/1``` | 200, 404, 422 | update category with id 1 and with same data from POST method
| DELETE | ```/api/categories/1``` | 200*, 404 | delete category with id 1
| GET | ```/api/tasks``` | 200 | list all tasks with pagination
| GET | ```/api/tasks/1``` | 200, 404 | show task with id 1
| POST | ```/api/tasks``` |  201, 422 | create task with following data:<br />- ```title```: required, up to 25 characters<br />- ```description```: not required<br />- ```start_date```: not required, date in format ```Y-m-d``` (like ```1988-04-07```)<br />- ```start_time```: required if ```start_time``` is present, time in format ```H:i:s``` (like ```08:28:00```)<br />- ```end_date```: not required, same format as ```start_date```<br />- ```end_time```: required if ```end_time``` is present, same format as ```start_time```<br />- ```category_id```: not required, ```id``` of an existing category
| PUT | ```/api/tasks/1``` | 200, 404, 422 | update task with id 1 and with same data from POST method
| DELETE | ```/api/tasks/1``` | 200*, 404 | delete task with id 1

*\* Should be 204, but I tried to keep the same structure in response for all requests as below.*

The response is always be with this structure:

- Example of success (200, 201):
    ```
    {
        data: <object|array of objects>,
        error: null,
    }
    ```

- Example of error (404, 422, 500):
    ```
    {
        data: null,
        error: [
            <one or more errors>,
        ],
    }
    ```

### Frontend

- JavaScript/jQuery: soon!

- JavaScript/Vue: soon!

- TypeScript/Angular: soon!

### Mobile

- Android/Kotlin: soon!

- iOS/Swift: soon!
