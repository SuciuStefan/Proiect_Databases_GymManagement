# Gym Management System

A fullstack web application built as a **Databases Laboratory project**, simulating a basic gym management system. It handles client and trainer records, subscriptions, workouts, and product orders — all backed by a relational database.

---

## Tech Stack

| Layer     | Technology          |
|-----------|---------------------|
| Backend   | PHP (legacy version) |
| Frontend  | HTML, CSS           |
| Database  | MySQL (via PHP MySQLi/PDO) |

> **Note:** This project was built for academic purposes using an older version of PHP. It is not production-ready and does not follow modern security practices (e.g., no prepared statements enforcement, no hashed passwords, etc.).

---

## Features

- **Authentication** — Login/logout system (`login.php`, `logout.php`)
- **Client Management** — Add, edit, delete, and view gym clients (`add_client.php`, `edit_client.php`, `delete_client.php`)
- **Trainer Management** — Add, edit, delete trainers (`add_trainer.php`, `edit_trainer.php`, `delete_trainer.php`)
- **Workout Logging** — Add and track training sessions (`adauga_antrenament.php`)
- **Subscription Management** — Renew and manage member subscriptions (`reinoire_abonament.php`)
- **Product Orders** — Order gym products (`comanda_produs.php`)
- **Filtering & Reports** — Filter records and view a Top 5 leaderboard (`filtre.php`, `top5.php`)
- **Gym Info Page** — Static info page about the gym (`info_sala.php`)
- **Shared Layout** — Common navigation, sidebar, and header components (`common_nav.php`, `sidebar.php`, `header.php`)

---

## Project Structure

```
/
├── index.php                  # Entry point
├── login.php / logout.php     # Auth
├── home.php                   # Dashboard
├── init.php                   # DB connection / initialization
│
├── add_client.php             # Add a new client
├── edit_client.php            # Select client to edit
├── edit_this_client.php       # Edit form for a specific client
├── delete_client.php          # Delete a client
│
├── add_trainer.php            # Add a new trainer
├── edit_trainer.php           # Select trainer to edit
├── edit_this_trainer.php      # Edit form for a specific trainer
├── delete_trainer.php         # Delete a trainer
│
├── adauga_antrenament.php     # Log a workout session
├── reinoire_abonament.php     # Renew a subscription
├── comanda_produs.php         # Place a product order
│
├── filtre.php                 # Filter/search records
├── top5.php                   # Top 5 clients report
├── info_sala.php              # Gym info page
│
├── common_nav.php             # Shared navigation bar
├── sidebar.php                # Shared sidebar
├── header.php                 # Shared page header
│
├── style.css                  # Main stylesheet
├── style_login.css            # Login page stylesheet
└── *.png / *.jpg              # Static assets (logo, gym photos)
```

---

## Setup & Running Locally

**Requirements:** A local PHP + MySQL environment. [XAMPP](https://www.apachefriends.org/) or [WAMP](https://www.wampserver.com/) are the easiest options.

1. Clone the repository:
   ```bash
   git clone https://github.com/SuciuStefan/Proiect_Databases_GymManagement.git
   ```

2. Move the folder into your server's web root:
   - XAMPP → `htdocs/`
   - WAMP → `www/`

3. Create a MySQL database and import the schema (if a `.sql` file is provided separately).

4. Update the DB credentials in `init.php`:
   ```php
   $host = "localhost";
   $user = "root";
   $password = "";
   $database = "gym_db";
   ```

5. Open your browser and navigate to:
   ```
   http://localhost/Proiect_Databases_GymManagement/
   ```

---

## Known Limitations

- Uses an outdated PHP version — not suitable for deployment.
- No input sanitization or prepared statements; vulnerable to SQL injection.
- Passwords are likely stored in plaintext.
- No role-based access control beyond a basic login check.

---

## License

Academic project — no license applied. Not intended for commercial or production use.
