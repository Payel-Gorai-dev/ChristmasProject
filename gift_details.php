<?php
session_start();
include "db.php";

if (!isset($_GET["id"])) {
    header("Location: gifts.php");
    exit();
}

$id = (int) $_GET["id"];

$stmt = $conn->prepare("SELECT * FROM gifts WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 0) {
    header("Location: gifts.php");
    exit();
}

$gift = $result->fetch_assoc();
?>

<!DOCTYPE html>

<html lang="en">

<head>

```
<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>
    <?php echo htmlspecialchars($gift["gift_name"]); ?>
</title>

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


    <?php if (isset($_SESSION["user_id"])) { ?>

        <li class="welcome-user">
            👋 Hi,
            <?php echo htmlspecialchars($_SESSION["user_name"]); ?>
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

        <li>
            <a href="logout.php" class="logout-btn">
                Logout
            </a>
        </li>

    <?php } else { ?>

        <li>
            <a href="login.php" class="login-btn">
                Login
            </a>
        </li>

        <li>
            <a href="register.php" class="register-btn">
                Register
            </a>
        </li>

    <?php } ?>

</ul>
```

</nav>

<!-- GIFT DETAILS -->

<section class="gift-details-section">

```
<div class="gift-details-container">


    <!-- IMAGE -->
    <div class="gift-details-image">

        <img
            src="<?php echo htmlspecialchars($gift["image"]); ?>"
            alt="<?php echo htmlspecialchars($gift["gift_name"]); ?>"
        >

    </div>



    <!-- INFORMATION -->
    <div class="gift-details-info">

        <span class="gift-category">
            🎄 Christmas Special
        </span>


        <h1>
            <?php echo htmlspecialchars($gift["gift_name"]); ?>
        </h1>


        <p class="gift-description">
            <?php echo htmlspecialchars($gift["description"]); ?>
        </p>


        <h2 class="gift-price">
            ₹<?php echo number_format($gift["price"], 2); ?>
        </h2>



        <!-- ADD TO CART FORM -->
        <div class="gift-buttons">

            <form
                action="add_to_cart.php"
                method="POST"
            >

                <input
                    type="hidden"
                    name="gift_id"
                    value="<?php echo $gift["id"]; ?>"
                >

                <button
                    type="submit"
                    class="add-cart-btn"
                >
                    🛒 Add to Cart
                </button>

            </form>


            <a
                href="gifts.php"
                class="back-shop-btn"
            >
                ← Back to Shop
            </a>

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
