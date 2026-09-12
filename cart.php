<?php
session_start();
include "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

$sql = "
    SELECT 
        cart.id AS cart_id,
        cart.quantity,
        gifts.id AS gift_id,
        gifts.gift_name,
        gifts.description,
        gifts.price,
        gifts.image
    FROM cart
    INNER JOIN gifts ON cart.gift_id = gifts.id
    WHERE cart.user_id = ?
    ORDER BY cart.created_at DESC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$total = 0;
?>

<!DOCTYPE html>

<html lang="en">

<head>

```
<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>My Shopping Cart</title>

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

<!-- CART SECTION -->

<section class="cart-section">

```
<h1>
    🛒 My Shopping Cart
</h1>

<p class="cart-subtitle">
    Your selected Christmas gifts 🎄🎁
</p>


<div class="cart-container">

    <?php if ($result->num_rows > 0) { ?>

        <?php while ($row = $result->fetch_assoc()) {

            $subtotal = $row["price"] * $row["quantity"];
            $total += $subtotal;
        ?>

            <!-- CART ITEM -->
            <div class="cart-item">

                <!-- IMAGE -->
                <img
                    src="<?php echo htmlspecialchars($row["image"]); ?>"
                    alt="<?php echo htmlspecialchars($row["gift_name"]); ?>"
                >


                <!-- INFORMATION -->
                <div class="cart-item-info">

                    <h2>
                        <?php echo htmlspecialchars($row["gift_name"]); ?>
                    </h2>


                    <p class="cart-price">
                        ₹<?php echo number_format($row["price"], 2); ?>
                    </p>


                    <!-- QUANTITY -->
                    <div class="quantity-control">


                        <!-- MINUS -->
                        <form
                            action="update_cart.php"
                            method="POST"
                        >

                            <input
                                type="hidden"
                                name="cart_id"
                                value="<?php echo $row["cart_id"]; ?>"
                            >

                            <input
                                type="hidden"
                                name="action"
                                value="decrease"
                            >

                            <button
                                type="submit"
                                class="quantity-btn"
                            >
                                ➖
                            </button>

                        </form>


                        <!-- QUANTITY NUMBER -->
                        <span class="quantity-number">
                            <?php echo $row["quantity"]; ?>
                        </span>


                        <!-- PLUS -->
                        <form
                            action="update_cart.php"
                            method="POST"
                        >

                            <input
                                type="hidden"
                                name="cart_id"
                                value="<?php echo $row["cart_id"]; ?>"
                            >

                            <input
                                type="hidden"
                                name="action"
                                value="increase"
                            >

                            <button
                                type="submit"
                                class="quantity-btn"
                            >
                                ➕
                            </button>

                        </form>

                    </div>


                    <!-- SUBTOTAL -->
                    <h3>

                        Subtotal:

                        ₹<?php
                        echo number_format($subtotal, 2);
                        ?>

                    </h3>


                    <!-- REMOVE -->
                    <form
                        action="remove_cart.php"
                        method="POST"
                    >

                        <input
                            type="hidden"
                            name="cart_id"
                            value="<?php echo $row["cart_id"]; ?>"
                        >

                        <button
                            type="submit"
                            class="remove-btn"
                            onclick="return confirm('Remove this gift from your cart?');"
                        >
                            🗑️ Remove
                        </button>

                    </form>

                </div>

            </div>

        <?php } ?>


        <!-- TOTAL -->
        <div class="cart-total">

            <h2>
                Total:
                ₹<?php echo number_format($total, 2); ?>
            </h2>

            <a href="checkout.php" class="checkout-btn">
                Proceed to Checkout 📦
            </a>

        </div>


    <?php } else { ?>


        <!-- EMPTY CART -->
        <div class="empty-cart">

            <h2>
                🛒 Your cart is empty!
            </h2>

            <p>
                Start shopping and add some Christmas gifts! 🎄
            </p>

            <a
                href="gifts.php"
                class="continue-shopping-btn"
            >
                🎁 Continue Shopping
            </a>

        </div>

    <?php } ?>

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
