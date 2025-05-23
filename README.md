# Task Manager 📋

A lightweight LAMP-stack web app for keeping yourself (and small teams) accountable.  
Features include:

*   Personal accounts with hashed passwords
*   Create / edit / delete tasks
*   Priority & status filters
*   Notification bell with live badge
*   Fully responsive – built on **HTML 5 / CSS Grid / vanilla JS**
*   Hardened back-end (prepared statements, sessions, CSRF)

---

## Tech stack

| Layer      | Tech                         |
|------------|-----------------------------|
| Front-end  | HTML5, CSS3 (custom), vanilla JS |
| Back-end   | PHP 8.2 (mysqli)            |
| Database   | MySQL 8                     |
| Dev ops    | Docker Compose / or XAMPP   |

---

## Quick-start (local)

```bash
# 1  Clone
git clone https://github.com/heckermonn/task-manager.git
cd task-manager

# 2  Spin up a local LAMP stack
docker compose up -d        # or start Apache & MySQL in XAMPP

# 3  Install PHP deps (if you add any later)
composer install            # optional – none required right now

# 4  Create & seed the database
mysql -uroot -p < db/createdb.sql

# 5  Copy env & set your own creds
cp credentials.sample.php credentials.php
# then edit credentials.php or export ENV vars (see below)

# 6  Browse!
open http://localhost:8080   # or whatever port Apache maps to

Environment variables
Name	Purpose
DB_HOST	MySQL host (default localhost)
DB_USER	Database user
DB_PASS	Database user password
DB_NAME	Schema name (taskmanager)

If any of these are missing, database.php falls back to the values inside credentials.php.

Folder structure

├── db/
│   └── createdb.sql
├── images/
│   └── notificon.svg (or .png)
├── js/
│   ├── script.js
│   ├── task.js
│   ├── login.js
│   └── register.js
├── css/
│   └── style.css
├── php/
│   ├── database.php
│   ├── validate_login.php
│   ├── register_usr.php
│   ├── tasks.php
│   ├── insert.php
│   ├── alter.php
│   ├── update_status.php
│   └── delete.php
└── index.html

Security notes
Prepared statements everywhere.
Never concat SQL – see database.php helpers.

Password hashing.
We use password_hash($pass, PASSWORD_BCRYPT) and verify on login.

CSRF protection.
Each mutating form includes a hidden token stored in $_SESSION['csrf'].

Session hardening.
Session ID regenerates on login; script exits if $_SESSION['user_id'] is missing.

Authors

Louis Tran – Lead developer

Alex Ala-Kantti – Front-end

Ayman Nasir – Back-end