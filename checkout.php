<?php
session_start();
include "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];


/* GET PRODUCTS FROM CART */

$sql = "
    SELECT
        cart.id AS cart_id,
        cart.quantity,
        gifts.gift_name,
        gifts.price,
        gifts.image
    FROM cart
    INNER JOIN gifts
    ON cart.gift_id = gifts.id
    WHERE cart.user_id = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();


/* IF CART IS EMPTY, SEND USER TO CART PAGE */

if ($result->num_rows == 0) {
    header("Location: cart.php");
    exit();
}


/* TOTAL CALCULATE */

$total = 0;
$cart_items = [];

while ($row = $result->fetch_assoc()) {

    $subtotal = $row["price"] * $row["quantity"];

    $total += $subtotal;

    $row["subtotal"] = $subtotal;

    $cart_items[] = $row;
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

```
<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
>

<title>Checkout</title>

<link
    rel="stylesheet"
    href="christmas.css"
>
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
        <a href="index.php">
            Home
        </a>
    </li>


    <li>
        <a href="gifts.php">
            Shop 🎁
        </a>
    </li>


    <li>
        <a href="all_wishes.php">
            Wishes 💌
        </a>
    </li>


    <li>
        <a href="cart.php">
            Cart 🛒
        </a>
    </li>


    <li>
        <a href="my_orders.php">
            My Orders 📦
        </a>
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

<!-- CHECKOUT SECTION -->

<section class="checkout-section">

```
<h1>
    📦 Checkout
</h1>


<p class="checkout-subtitle">
    Complete your order details 🎄
</p>



<div class="checkout-container">


    <!-- DELIVERY FORM -->
    <div class="checkout-form-box">


        <h2>
            🚚 Delivery Details
        </h2>


        <form
            action="place_order.php"
            method="POST"
        >


            <label>
                Full Name
            </label>


            <input
                type="text"
                name="customer_name"
                placeholder="Enter your full name"
                required
            >



            <label>
                Phone Number
            </label>


            <input
                type="tel"
                name="phone"
                placeholder="Enter your phone number"
                required
            >



            <label>
                Delivery Address
            </label>


            <textarea
                name="address"
                placeholder="Enter your complete address"
                required
            ></textarea>



            <input
                type="hidden"
                name="total_amount"
                value="<?php echo $total; ?>"
            >



            <button
                type="submit"
                class="place-order-btn"
            >
                🎄 Place Order
            </button>


        </form>

    </div>



    <!-- ORDER SUMMARY -->
    <div class="order-summary">


        <h2>
            🛒 Order Summary
        </h2>


        <?php foreach ($cart_items as $item) { ?>


            <div class="summary-item">


                <img
                    src="<?php echo htmlspecialchars($item["image"]); ?>"
                    alt="<?php echo htmlspecialchars($item["gift_name"]); ?>"
                >


                <div>


                    <h3>
                        <?php echo htmlspecialchars($item["gift_name"]); ?>
                    </h3>


                    <p>

                        ₹<?php echo number_format($item["price"], 2); ?>

                        ×

                        <?php echo $item["quantity"]; ?>

                    </p>


                </div>


                <strong>

                    ₹<?php
                    echo number_format($item["subtotal"], 2);
                    ?>

                </strong>


            </div>


        <?php } ?>


        <hr>


        <div class="checkout-total">

            <h2>

                Total:

                ₹<?php echo number_format($total, 2); ?>

            </h2>

        </div>


    </div>


</div>
```

</section>

<!-- FOOTER -->

<footer>

```
<p>
    🎄 Merry Christmas & Happy New Year 🎆
</p>

<p>
    Made with ❤️ for Christmas Celebration
</p>
```

</footer>

</body>

</html>
