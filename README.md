# Job Application Tracker

A simple PHP + MySQL web app to keep track of the jobs you apply for.
Users can sign up, log in, and add, update, view and delete their job applications.

## Features
- Sign up and log in with email and password (passwords are hashed)
- Add a job: company, title, source platform, job URL, status
- Update the status (Applied, Interviewing, Offered, Rejected)
- View all applications in a table
- Delete an application
- Animated, glass-style design that works on mobile

## Requirements
- XAMPP (Apache + MySQL) or any PHP 7.4+ server
- A web browser

## Setup
1. Start **Apache** and **MySQL** in the XAMPP Control Panel.
2. Copy the `job-tracker` folder to `C:\xampp\htdocs\`.
3. Open `http://localhost/phpmyadmin` and use the database named `login`.
4. Make sure the `my_jobs` table exists with these columns:
   `ID` (auto increment, primary key), `company_name`, `job_title`,
   `source_platform`, `job_url`, `application_status`.
5. In the **SQL** tab, run the code from `setup.sql` to create the `users` table.
6. Open `http://localhost/job-tracker/signup.php` and create your account.

If your database settings are different, edit `connect.php`
(host, user, password, database name).

## Pages
| File | What it does |
|---|---|
| `signup.php` | Create a new account |
| `login.php` | Log in |
| `logout.php` | Log out |
| `index.php` | Main page with the add, update, delete and view forms |
| `insert.php` | Saves a new job |
| `update.php` | Changes a job's status |
| `delete.php` | Deletes a job |
| `retrieve.php` | Shows all jobs in a table |
| `auth.php` | Blocks pages for users who are not logged in |
| `connect.php` | Database connection |
| `style.css`, `index.css` | Design and animations |
| `setup.sql` | Creates the `users` table |

## Notes
- All pages except login and sign up need a logged-in user.
- This project is for learning. Before putting it online, set a MySQL password
  and do not use the default `root` user with an empty password.
