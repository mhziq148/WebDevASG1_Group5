# ♻️ AnyFacture Studio - Circular Economy Furniture

A web application developed for **AnyFacture Studio**, specializing in premium furniture made entirely from recycled plastic waste. This platform bridges sustainable e-commerce with community engagement, allowing users to browse products, schedule plastic waste pickups, and offering administrators a complete dashboard for record and data management.

---

## Features

### 1. Admin Features
* **Secure Authentication:** Administrator login and session management (`login.php` / `logout.php`) to protect sensitive control panels.
* **Full CRUD Operations:** Administrators can view, create, update, and delete customer and product records through an intuitive dashboard.
* **Simple Reporting:** Generates real-time summary reports (such as total orders and user requests received) directly from the database.

### 2. User Features
* **Product Catalog:** Users can browse eco-friendly furniture items like the [EcoStack Lounge Chair](http://localhost/anyfacture/Product.html).
* **Interactive Requests/Bookings:** Users can submit orders or request pickups via the [Contact](http://localhost/anyfacture/Contact.php) page form, which saves data directly to the backend database.

### 3. Mobile Responsiveness
* **Flexible Layouts:** Fully responsive design utilizing CSS media queries and modern layouts ensuring seamless viewing across desktop, tablet, and mobile screens.

---

## Tech Stack
* **Frontend:** HTML5, CSS3, JavaScript
* **Backend:** PHP
* **Database:** MySQL / phpMyAdmin
* **Server Environment:** Apache (via XAMPP / WampServer)

---

##  Project Structure
```anyfacture/
│
├── Home.html          # Homepage & landing view
├── Products.html      # Product catalog page
├── Contact.php      # Customer request & pickup form
├── login.php          # Admin authentication page
├── dashboard.php      # Admin CRUD control panel & reports
├── process_order.php  # Backend form handler
└── style.css          # CSS stylesheets and images
```

---

## Installation & Setup
1. Download this repository into your local server directory (e.g. htdocs in XAMPP).
2. Start Apache & MySQL via your local server control panel
3. Set Up the Database:
   - Open phpMyAdmin (http://localhost/phpmyadmin).
   - Import and run the SQL queries to set up your orders table
4. Run the project
   - http://localhost/anyfacture/Home.html

---

## Database Setup
1. Open phpMyAdmin and go to **Import** tab, then upload 'anyfact_db.sql' file include in this repository
2. Click **Go** to set up the tables automatically.

---

## Dashboard
1. USERNAME = admin
2. PASSWORD = password123
