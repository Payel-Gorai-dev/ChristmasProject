<?php
session_start();

include "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$order_id = isset($_GET["order_id"]) ? (int)$_GET["order_id"] : 0;

if ($order_id <= 0) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION["user_id"];

$stmt = $conn->prepare("
    SELECT *
    FROM orders
    WHERE id = ? AND user_id = ?
");

$stmt->bind_param("ii", $order_id, $user_id);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: index.php");
    exit();
}

$order = $result->fetch_assoc();
?>

<!DOCTYPE html>

<html lang="en">

<head>

```
<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Order Successful 🎄</title>

<link rel="stylesheet" href="christmas.css">
```

</head>

<body>

<div class="snow"></div>

<!-- NAVBAR -->

<nav class="navbar">

```
<div class="logo">
    🎄 Christmas Shop
</div>


<ul class="nav-links">

    <li>
        <a href="index.php">Home</a>
    </li>

    <li>
        <a href="gifts.php">Shop 🎁</a>
    </li>

    <li>
        <a href="all_wishes.php">Wishes 💌</a>
    </li>

    <li>
        <a href="cart.php">Cart 🛒</a>
    </li>

    <li>
        <a href="my_orders.php">My Orders 📦</a>
    </li>

    <li class="welcome-user">
        👋 Hi, <?php echo htmlspecialchars($_SESSION["user_name"]); ?>
    </li>

    <li>
        <a href="logout.php" class="logout-btn">
            Logout
        </a>
    </li>

</ul>
```

</nav>

<!-- ORDER SUCCESS SECTION -->

<section class="order-success-section">

```
<div class="order-success-box">

    <div class="success-icon">
        🎉🎄📦
    </div>


    <h1>
        Order Placed Successfully!
    </h1>


    <p class="success-message">
        Thank you for shopping with Christmas Shop! ❤️
    </p>



    <!-- ORDER DETAILS -->
    <div class="order-details">

        <h2>Order Details</h2>


        <p>

            <strong>Order ID:</strong>

            #<?php echo $order["id"]; ?>

        </p>


        <p>

            <strong>Name:</strong>

            <?php echo htmlspecialchars($order["customer_name"]); ?>

        </p>


        <p>

            <strong>Phone:</strong>

            <?php echo htmlspecialchars($order["phone"]); ?>

        </p>


        <p>

            <strong>Delivery Address:</strong>

            <?php echo htmlspecialchars($order["address"]); ?>

        </p>


        <p class="success-total">

            <strong>Total Amount:</strong>

            ₹<?php echo number_format($order["total_amount"], 2); ?>

        </p>

    </div>



    <!-- BUTTONS -->
    <div class="success-buttons">

        <a
            href="my_orders.php"
            class="view-orders-btn"
        >
            📦 View My Orders
        </a>


        <a
            href="gifts.php"
            class="continue-shopping-btn"
        >
            Continue Shopping 🎁
        </a>


        <a
            href="index.php"
            class="success-home-btn"
        >
            Back to Home 🏠
        </a>

    </div>

</div>
```

</section>

<!-- FOOTER -->

<footer>

```
<p>
    🎄 Merry Christmas & Happy Shopping! 🎁
</p>

<p>
    © 2026 Christmas Shop
</p>
```

</footer>

</body>

</html>
