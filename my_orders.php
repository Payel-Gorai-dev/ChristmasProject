<?php

session_start();

include "db.php";


/* LOGIN CHECK */

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    exit();

}


$user_id = $_SESSION["user_id"];


/* GET ALL ORDERS OF CURRENT USER */

$stmt = $conn->prepare(

    "SELECT * FROM orders
     WHERE user_id = ?
     ORDER BY id DESC"

);

$stmt->bind_param("i", $user_id);

$stmt->execute();

$result = $stmt->get_result();

?>

<!DOCTYPE html>

<html lang="en">

<head>

```
<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>My Orders - Christmas Shop</title>

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

        👋 Hi,
        <?php echo htmlspecialchars($_SESSION["user_name"]); ?>

    </li>


    <li>
        <a
            href="logout.php"
            class="logout-btn"
        >
            Logout
        </a>
    </li>

</ul>
```

</nav>

<!-- MY ORDERS SECTION -->

<section class="my-orders-section">

```
<h1>
    📦 My Orders
</h1>


<p class="orders-subtitle">
    View all your Christmas gift orders here 🎄
</p>



<div class="orders-container">


    <?php

    if ($result->num_rows > 0) {

        while ($order = $result->fetch_assoc()) {

    ?>


    <div class="order-card">


        <div class="order-card-header">


            <h2>
                🎁 Order #<?php echo $order["id"]; ?>
            </h2>


            <span class="order-status">
                <?php echo htmlspecialchars($order["order_status"]); ?>
            </span>


        </div>



        <div class="order-card-details">


            <p>

                <strong>👤 Name:</strong>

                <?php
                echo htmlspecialchars($order["customer_name"]);
                ?>

            </p>



            <p>

                <strong>📞 Phone:</strong>

                <?php
                echo htmlspecialchars($order["phone"]);
                ?>

            </p>



            <p>

                <strong>📍 Delivery Address:</strong>

                <?php
                echo htmlspecialchars($order["address"]);
                ?>

            </p>



            <p class="order-price">

                <strong>Total Amount:</strong>

                ₹<?php
                echo number_format(
                    $order["total_amount"],
                    2
                );
                ?>

            </p>


        </div>


    </div>


    <?php

        }

    } else {

    ?>


    <!-- NO ORDERS -->

    <div class="no-orders">


        <div class="no-orders-icon">
            📦
        </div>


        <h2>
            No Orders Yet!
        </h2>


        <p>
            You haven't ordered any Christmas gifts yet.
        </p>


        <a
            href="gifts.php"
            class="start-shopping-btn"
        >
            Start Shopping 🎁
        </a>


    </div>


    <?php

    }

    ?>


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
