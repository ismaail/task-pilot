# Task Pilot (WIP)

The primary goal of **Task Pilot** is to track time spent on a projet.
 
This project is build with **Laravel Livewire** & **Alpinejs**.

[![run-tests](https://github.com/ismaail/task-pilot/actions/workflows/run-tests.yml/badge.svg)](https://github.com/ismaail/task-pilot/actions/workflows/run-tests.yml)

<br>

![board!](/docs/assets/board.png)

<br>

## Steps to test

1. Clone the projet
2. cd into the project folder
3. Install dependencies with `composer install`
4. Copy `env.example` to `.env` and adjust as needed 
5. Populate the database with `php artisan migrate --seed`
6. Install assets with `yarn` or `npm i`
7. Start the server with `php artisan serve`
8. Open the Browser and go to url `http://localhost:8000/boards/1`
9. Login with `email = test@example.com` and `password = password`

---

<br>

---

## Milestones

1. ### Version 1.0
   - [ ] List & Create Boards
   - [X] Run/Stop a Task
   - [x] Create/Delete Tasks
   - [x] Move/Sort Tasks Tasks
   - [ ] Assign Members to a Task
   - [ ] CRUD Buckets
   - [ ] Move/Sort Buckets

2. ### Version 2.0: Multi Tenancy
	- __T/B__

3. ### Version 3.0: GraphQL API
	- __T/B__
