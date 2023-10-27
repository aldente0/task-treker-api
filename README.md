# Task Manager Api

This is my first test assignment from an employer.

## Task

Implement the task tracker API on any php framework.

### Input data

You need to implement a data schema:

1) Table projects (projects)
id - Primary key
name

2) task status (status)
id - Primary key
name (New, in progress, testing, completed)

3) Task type (types)
id - Primary key
name (wish, error, accident)

4) task table (tasks)
id - Primary key
project_id - project id
status_id - status id
type_id - type id
title - task
name description - detailed description


API:
Projects
GET /api/projects - getting a list of projects
POST /api/project - adding a project

tasks
GET /api/tasks/{project_id} - getting a list of tasks for a project
POST /api/tasks/{project_id} - creating a task

PUT /api/task/{task_id} - updating the task
DELETE /api/task/{task_id} - deleting a task

Good luck to me!!!
