# Task Manager Api

This is my first test assignment from an employer.

## Task

Implement the task tracker API on any php framework. I used Laravel.

## Input data

I have implemented a data schema:

1) Table projects (projects)
id - Primary key,
name

2) task status (status)
id - Primary key,
name (новая, выполняется, тестирование, завершена)

3) Task type (types)
id - Primary key,
name (пожелание, ошибка, авария)

4) task table (tasks)
id - Primary key,
project_id - project id,
status_id - status id,
type_id - type id,
title - task name,
description - detailed description

## API:

### Acceptable Content-Types

multipart/form-data, application/x-www-form-urlencoded

### Projects

GET /api/projects - getting a list of projects

POST /api/project - adding a project.  Expects data with the keys: name.


### Tasks

GET /api/tasks/{project_id} - getting a list of tasks for a project

POST /api/tasks/{project_id} - creating a task. Expects data with the keys: type_id, status_id, title and description.

POST /api/task/{task_id} - updating the task. Expects data with any of keys: type_id, status_id, title or description and (required) _method:put (needed for the correct operation of the put method).

or

PUT /api/task/{task_id} - with Content-Type: application/x-www-form-urlencoded

DELETE /api/task/{task_id} - deleting a task


### Valid key values

type_id: 1 - пожелание, 2 - ошибка, 3 - авария.

status_id: 1 - новая. 2 - выполняется, 3 - тестируется, 4 - завершена


### Response examples

Get methods successfully:

[
    {
        "id": 1,
        ...
    },
    {
        "id": 2,
        ...
    },
]

Post, put successfully:

{
    {
        "id": 1,
        ...,
        'project': {}
    },
}

Delete method successfully:

{ 
    "message": "Task deleted successfully"
}

Validation errors:

{
    "title": ["The title field is required."]
}

Incorrect project_id or task_id in routes:

{
    "message": "No query results for model [App\Models\Project] 35"
}
