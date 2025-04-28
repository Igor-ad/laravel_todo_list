<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Laravel TODO List REST API / and WEB

#### Required version: `PHP 8.1 or later`

### Task searching filters and ordering expressions.

Fields for searching:

( Allowed sorting directions for GET request are set in OrderDirectionEnum, allowed 'up' and 'dw')

- status
    - GET query `&status=todo`
    - SQL query `status = 'todo'`
- priority
    - GET query `&priority=2`
    - SQL query `priority >= 2`
- title
    - GET query `&title=Title_of_task`
    - SQL query `(full text searching) MATCH (title) AGAINST ('Title_of_task')`

Fields for ordering:

- priority
    - GET query `&prioritySort=up`
    - SQL query `order by priority asc`
- created_at
    - GET query `&createdSort=dw`
    - SQL query `order by cteated_at desc`
- completed_at
    - GET query `&completedSort=dw`
    - SQL query `order by comlpeted_at desc`

Example GET query:

```
GET http://my_tasks_manager.com:80/tasks/?status=todo&priority=2&createdSort=up&prioritySort=dw
```

Show request

```
{
    "status": 200,
    "message": "All tasks",
    "data": [
        {
            "id": 375,
            "parent_id": 21,
            "user_id": 857,
            "status": "todo",
            "priority": 2,
            "title": "Test Task",
            "description": "Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...",
            "created_at": "2123-07-31T21:32:38.000000Z",
            "updated_at": "2123-08-12T08:45:59.000000Z",
            "completed_at": null
        },
        {
            "id": 1431,
            "parent_id": 17,
            "user_id": 857,
            "status": "todo",
            "priority": 2,
            "title": "New Task",
            "description": "Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus.",
            "created_at": "2123-08-13T19:38:39.000000Z",
            "updated_at": "2123-09-15T20:06:17.000000Z",
            "completed_at": null
        }
    ]
}
```

### Show one task only

Example GET query show task id=869:

```
GET http://my_tasks_manager.com:80/api/tasks/show/869
```

Show request

```
{
    "status": 200,
    "message": "Task ID 869.",
    "data": {
        "id": 869,
        "parent_id": 37,
        "user_id": 418,
        "status": "done",
        "priority": 3,
        "title": "Old Task",
        "description": " Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.",
        "created_at": "2123-08-11T11:38:39.000000Z",
        "updated_at": "2123-08-12T20:06:17.000000Z",
        "completed_at": "2123-08-12T20:06:17.000000Z"
    }
}
```

### The status of the task is set to "done".

Example PUT query sets status to 'done' task id=869:

```
PUT http://my_tasks_manager.com:80/api/tasks/complete/869
```

Show request (all children have status 'todo')

```
{
    "status": 200,
    "message": "Task ID 869 was marked 'done' successfully",
    "data": true
}
```

Show request (children have status 'done')

```
{
    "status": 200,
    "message": "One or more children of Task ID 1 have status 'done'.",
    "data": false
}
```

### Delete Task

Example DELETE Query, delete task id=883:

```
DELETE http://my_tasks_manager.com:80/api/tasks/delete/883
```

Show request (Task status is 'todo')

```
{
    "status": 200,
    "message": "Task ID 883 was deleted successfully.",
    "data": true
}
```

Show request (Task status is 'done')

```
{
    "status": 200,
    "message": "Task ID 883 status: 'done'. Please select another task.",
    "data": {
        "id": 883,
        "parent_id": 37,
        "user_id": 418,
        "status": "done",
        "priority": 3,
        "title": "Old Task",
        "description": " Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.",
        "created_at": "2123-08-13T11:38:39.000000Z",
        "updated_at": "2123-08-15T20:06:17.000000Z",
        "completed_at": "2123-08-15T20:06:17.000000Z"
    }
}
```

### Update Task

Example Update query:

```
PUT http://my_tasks_manager.com:80/api/tasks/update/?id=391&description=Start_new_project
```

Show request

```
{
    "status": 200,
    "message": "Task was updated successfully.",
    "data": {
        "id": 391,
        "parent_id": 47,
        "user_id": 179,
        "status": "done",
        "priority": 1,
        "title": "New_project",
        "description": "Start_new_project",
        "created_at": "2123-08-12T18:45:09.000000Z",
        "updated_at": "2123-08-15T19:21:26.000000Z",
        "completed_at": "2123-08-15T19:21:26.000000Z"
    }
}
```

===============

add branch dev

===============

##### Examples of web pages

![image](public/img/create_m.jpg)
![image](public/img/view_m.jpg)
![image](public/img/edit_m.jpg)
![image](public/img/index.png)
![image](public/img/create.png)
![image](public/img/view.png)
![image](public/img/view_not_found_task.png)
![image](public/img/edit.png)
![image](public/img/edit_errors_of_validation.png)

If you find any errors, please email admin@autodoctor.od.ua
