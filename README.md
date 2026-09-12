# 🎄 Christmas Gift Shop

A full-stack e-commerce web application built with **PHP** and **MySQL**, where users can browse Christmas gifts, add them to a cart, place orders, and track order status — with a secure admin panel to manage orders.

![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat&logo=mysql&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=flat&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=flat&logo=css3&logoColor=white)

---

## ✨ Features

### For customers
- 🔐 **Secure authentication** — registration and login with hashed passwords (`password_hash` / `password_verify`)
- 🎁 **Browse gifts** — view all available Christmas gifts with images, descriptions, and prices
- 🔍 **Search** — find gifts by name
- 🛒 **Shopping cart** — add items, increase/decrease quantity, remove items
- 💳 **Checkout** — enter delivery details and place an order (total is recalculated server-side from the cart for security)
- 📦 **Order tracking** — customers can view their own order history and current status (Pending / Shipped / Delivered / Cancelled)
- 💌 **Christmas wishes** — a public guestbook where visitors can leave festive messages
- 🗑️ **Account deletion** — users can permanently delete their account

### For admins
- 📊 **Admin dashboard** — view every order placed on the platform
- 🔄 **Order status management** — update any order's status from a dropdown

### Security highlights
- All database queries use **prepared statements** to prevent SQL injection
- Passwords are hashed, never stored in plain text
- Users can only view/edit their own cart and orders (ownership checks on every request)
- Order totals are recalculated from the database on checkout, never trusted from client input
- Admin routes are protected by a session-based role check

---

## 🛠️ Tech Stack

| Layer | Technology |
|---|---|
| Backend | PHP (procedural, `mysqli` with prepared statements) |
| Database | MySQL |
| Frontend | HTML5, CSS3, vanilla JavaScript |
| Local environment | XAMPP (Apache + MySQL) |

---

## 📁 Project Structure

```
ChristmasProject/
├── index.php              # Home page
├── login.php               # Login (redirects admins to admin_dashboard.php)
├── register.php             # User registration
├── logout.php               # Session destroy
├── db.php                    # Database connection
├── gifts.php                  # Gift listing + search
├── gift_details.php            # Single gift details
├── add_to_cart.php              # Add item to cart
├── cart.php                      # View/manage cart
├── update_cart.php                # Change item quantity
├── remove_cart.php                 # Remove item from cart
├── checkout.php                     # Delivery details form
├── place_order.php                   # Process order, empty cart
├── order_success.php                  # Order confirmation
├── my_orders.php                       # Customer's own order history
├── admin_dashboard.php                  # Admin: view/manage all orders
├── update_order_status.php               # Admin: update order status
├── delete_account.php                     # Delete user account
├── save_wish.php                           # Save a Christmas wish
├── all_wishes.php                           # View all wishes
├── christmas.css                             # Site-wide styling
└── script.js                                  # Front-end interactivity
```

---

## 🗄️ Database Schema

**Database:** `christmas_db`

| Table | Purpose |
|---|---|
| `users` | Customer & admin accounts (`is_admin` flag distinguishes roles) |
| `gifts` | Product catalog |
| `cart` | Items each user has added to their cart |
| `orders` | Placed orders with delivery details, total, and status |
| `wishes` | Public Christmas greeting messages |

---

## 🚀 Setup Instructions

1. Install [XAMPP](https://www.apachefriends.org/) and start **Apache** and **MySQL**
2. Clone/copy this project into `C:\xampp\htdocs\ChristmasProject`
3. Open `http://localhost/phpmyadmin` and create a database named `christmas_db`
4. Import the provided SQL schema (or create the tables listed above)
5. Update `db.php` with your database credentials if different from defaults
6. Visit `http://localhost/ChristmasProject/index.php` in your browser

To create an admin account, register normally, then run:
```sql
UPDATE users SET is_admin = 1 WHERE email = 'your_email@example.com';
```

---

## 📸 Screenshots

### Home Page
![Home Page](screenshots/home.png)

### Login
![Login Page](screenshots/login.png)

### Gift Shop (with search)
![Gift Shop](screenshots/shop.png)

### Shopping Cart
![Cart](screenshots/cart.png)

### Checkout
![Checkout](screenshots/checkout.png)

### Christmas Wishes
![Wishes](screenshots/wishes.png)

### Admin Dashboard
![Admin Dashboard](screenshots/admin_dashboard.png)

---

## 🙋 Author

Built by Payel Gorai as a full-stack learning project.

---

## 📄 License

This project is open source and available for learning purposes.
