Installation
-----------------------
1. Open project location
2. >git clone https://github.com/abdusaziz/LaravelTodo.git
3. >cd LaravelTodo
4. >code . to open VisualStudio Code
5. >composer update
6. Duplicte .env.example file & rename to .env
7. >php artisan key:generate
8. >npm install
9. >npm run dev
10. >php artisan serve to test

The app is ready to use.

To create the app used
-----------------------
=> Laravel 10.x
=> PHP 8.1.12
=> MySql 10.4.27-MariaDB

=> Authentication: ui bootstrap
=> Template: Blade
=> Eloquent Relation: OneToOne
=> Pagination: Bootstrap4
=> Debugging : Debugbar
=> JS library : Bootstrap + jQuery


App Uses
-----------------------
1. Can login, register, reset password
2. After login in navbar click to "Todo" Menu

###.Todo Page.###

3. In Todo page Title bar will show the Page Name

4. click "Create new" button to create new todo item (Modal will appear). Todo "Name" must be unique

5. Todo page table will show 10row per page, after that pagination bar will appar down to the table

6. Todo page Table Details:
    SL: to maintain serial
    Name:            Todo item name (Related to the authenticated user)
    Task Remain:     Remaining tasks (related to the specific Todo item)
    Completion%:     Completed task % of total tasks (related to the specific Todo item)
    Rename (button): To rename the task name (Modal will appear)
    View (button):   to view all tasks (related to the specific Todo item)
    Delete (Button): To delete specific Todo item

###.Task Page.###

7. In Task page Title bar will show the Page Name & Todo name

8. click "Create new" button to create new Task (Modal will appear). Task "Name" must be unique

9. Task page table will show 5row per page, after that pagination bar will appar down to the table

10. Task page Table Details:
    SL: to maintain serial
    Task Name: Task name (Related to the Todo item which mentioned in titlebar)
    Task Description: Task Description of the task
    Status: Task status (Complete or Pending)
    Edit (Button): To edit Task (Modal will appear). To change Name, Descripttion or Status of a task
    View (button): to view a task (Modal will appear)
    Delete (Button) : To delete specific Task

