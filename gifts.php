<?php
session_start();
include "db.php";

$search = isset($_GET["search"]) ? trim($_GET["search"]) : "";

if ($search !== "") {

    $sql = "SELECT * FROM gifts WHERE gift_name LIKE ? ORDER BY created_at DESC";
    $stmt = $conn->prepare($sql);
    $search_param = "%" . $search . "%";
    $stmt->bind_param("s", $search_param);
    $stmt->execute();
    $result = $stmt->get_result();

} else {

    $sql = "SELECT * FROM gifts ORDER BY created_at DESC";
    $result = $conn->query($sql);

}
?>

<!DOCTYPE html>

<html lang="en">

<head>


<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Christmas Gift Shop</title>

<link rel="stylesheet" href="christmas.css">


</head>

<body>

<div class="snow"></div>

<!-- NAVBAR -->

<nav class="navbar">


<div class="logo">
    🎄 Christmas Shop
</div>


<ul class="nav-links">

    <li>
        <a href="index.php">Home</a>
    </li>

    <li>
        <a href="index.php#about">About</a>
    </li>

    <li>
        <a href="gifts.php">Shop 🎁</a>
    </li>

    <li>
        <a href="all_wishes.php">All Wishes</a>
    </li>


    <?php if (isset($_SESSION["user_id"])) { ?>

        <li class="welcome-user">
            👋 Hi, <?php echo htmlspecialchars($_SESSION["user_name"]); ?>
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


</nav>

<!-- GIFTS PAGE -->

<section class="database-gifts-section">


<h1>
    🎁 Christmas Gift Shop
</h1>


<p class="gift-page-subtitle">
    Find the perfect Christmas gift for your loved ones! 🎄❤️
</p>
<form action="gifts.php" method="GET" class="search-form">

    <input
        type="text"
        name="search"
        placeholder="Search gifts... 🔍"
        value="<?php echo htmlspecialchars($search); ?>"
    >

    <button type="submit">Search</button>

    <?php if ($search !== "") { ?>
        <a href="gifts.php" class="clear-search-btn">Clear ✖</a>
    <?php } ?>

</form>

<div class="database-gifts-container">

    <?php

    if ($result && $result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {

    ?>

            <div class="database-gift-card">

                <img
                    src="<?php echo htmlspecialchars($row["image"]); ?>"
                    alt="<?php echo htmlspecialchars($row["gift_name"]); ?>"
                >


                <div class="database-gift-content">

                    <h2>
                        <?php echo htmlspecialchars($row["gift_name"]); ?>
                    </h2>


                    <p>
                        <?php echo htmlspecialchars($row["description"]); ?>
                    </p>


                    <h3>
                        ₹<?php echo number_format($row["price"], 2); ?>
                    </h3>


                    <a
                        href="gift_details.php?id=<?php echo $row["id"]; ?>"
                        class="view-gift-btn"
                    >
                        🎁 View Gift
                    </a>

                </div>

            </div>

    <?php

        }

    } else {

        echo "<p class='no-wishes'>No gifts available yet!</p>";

    }

    ?>

</div>


</section>

<!-- FOOTER -->

<footer>


<p>
    🎄 Merry Christmas & Happy New Year 🎆
</p>

<p>
    Made with ❤️ for Christmas Celebration
</p>


</footer>

</body>

</html>
