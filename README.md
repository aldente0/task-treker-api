# Task Manager Api

This is my first test assignment from an employer.

## Task

Implement the task tracker API on any php framework. I used Laravel.

## Input data

I have implemented a data schema:

1) Table projects (projects)
id - Primary key,
name

3) task status (status)
id - Primary key,
name (новая, выполняется, тестирование, завершена)

5) Task type (types)
id - Primary key,
name (пожелание, ошибка, авария)

7) task table (tasks)
id - Primary key,
project_id - project id,
status_id - status id,
type_id - type id,
title - task name,
description - detailed description

## API:


### Projects

GET /api/projects - getting a list of projects

POST /api/project - adding a project


### Tasks

GET /api/tasks/{project_id} - getting a list of tasks for a project

POST /api/tasks/{project_id} - creating a task. Expects form-data with the keys: type_id, status_id, title, description.

POST /api/task/{task_id} - updating the task. Expects form-data with the keys: type_id, status_id, title, description, _method:put (needed for the correct operation of the put method).

DELETE /api/task/{task_id} - deleting a task

### Valid key values

type_id: 1 - пожелание, 2 - ошибка, 3 - авария.

status_id: 1 - новая. 2 - выполняется, 3 - тестируется, 4 - завершена.
