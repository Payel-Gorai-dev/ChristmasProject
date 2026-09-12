<?php
session_start();
?>

<!DOCTYPE html>

<html lang="en">

<head>


<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Christmas Celebration</title>

<link rel="stylesheet" href="christmas.css">

</head>

<body>

<!-- SNOW -->

<div class="snow"></div>

<!-- NAVBAR -->

<nav class="navbar">


<div class="logo">
    🎄 Christmas
</div>


<ul class="nav-links">

    <li>
        <a href="#home">Home</a>
    </li>

    <li>
        <a href="#about">About</a>
    </li>

    <li>
        <a href="#gifts">Gifts</a>
    </li>

    <li>
        <a href="#wishes">Wishes</a>
    </li>

    <li>
        <a href="all_wishes.php">All Wishes</a>
    </li>


    <?php if (isset($_SESSION["user_id"])) { ?>

        <li class="welcome-user">
            👋 Hi,
            <?php echo htmlspecialchars($_SESSION["user_name"]); ?>
        </li>

        <!-- SHOP GIFTS -->
        <li>
            <a href="gifts.php">
                Shop 🎁
            </a>
        </li>

        <!-- CART -->
        <li>
            <a href="cart.php">
                Cart 🛒
            </a>
        </li>

        <!-- MY ORDERS -->
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

        <li>
            <a
                href="delete_account.php"
                class="delete-account-btn"
                onclick="return confirm('Are you sure you want to permanently delete your account? This action cannot be undone.');"
            >
                Delete Account
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

<!-- HOME SECTION -->

<section id="home" class="hero">


<div class="hero-content">

    <h1>
        Merry Christmas! 🎄
    </h1>

    <p>
        May your Christmas be filled with love,
        happiness and magical moments.
    </p>

    <button id="celebrateBtn">
        Celebrate 🎉
    </button>

</div>


<!-- CHRISTMAS SCENE -->
<div class="scene">

    <!-- SANTA -->
    <div class="santa">
        🎅
    </div>


    <!-- TREE -->
    <div class="tree-container">

        <div class="star">
            ★
        </div>


        <div class="tree">

            <div class="layer layer1">
                <div class="light red light1"></div>
            </div>


            <div class="layer layer2">

                <div class="light yellow light2"></div>

                <div class="light blue light3"></div>

            </div>


            <div class="layer layer3">

                <div class="light red light4"></div>

                <div class="light yellow light5"></div>

                <div class="light blue light6"></div>

            </div>

        </div>


        <div class="trunk"></div>

    </div>


    <!-- GIFTS -->
    <div class="gifts">

        <div class="gift gift1">
            🎁
        </div>

        <div class="gift gift2">
            🎁
        </div>

        <div class="gift gift3">
            🎁
        </div>

    </div>

</div>


</section>

<!-- ABOUT SECTION -->

<section id="about" class="about">


<h2>
    About Christmas 🎅
</h2>

<p>
    Christmas is a season of joy, love, kindness and togetherness.
    It is the perfect time to share happiness and create beautiful
    memories with family and friends.
</p>


</section>

<!-- GIFTS SECTION -->

<section id="gifts" class="gifts-section">


<h2>
    Christmas Gift Ideas 🎁
</h2>


<div class="gift-cards">

    <div class="gift-card">

        <div class="gift-icon">
            🎁
        </div>

        <h3>
            Special Gift
        </h3>

        <p>
            A beautiful surprise for someone special.
        </p>

    </div>


    <div class="gift-card">

        <div class="gift-icon">
            🎄
        </div>

        <h3>
            Christmas Decoration
        </h3>

        <p>
            Make your home magical this Christmas.
        </p>

    </div>


    <div class="gift-card">

        <div class="gift-icon">
            🍫
        </div>

        <h3>
            Sweet Treat
        </h3>

        <p>
            Share delicious Christmas happiness.
        </p>

    </div>

</div>


</section>

<!-- WISHES SECTION -->

<section id="wishes" class="wishes">


<h2>
    Send Christmas Wishes 💌
</h2>


<?php

if (isset($_GET["success"])) {

    echo '
    <p id="successMessage">
        🎄 Your Christmas wish was sent successfully! ❤️
    </p>
    ';

}

?>


<form
    action="save_wish.php"
    method="POST"
    id="wishForm"
>

    <input
        type="text"
        name="name"
        placeholder="Enter your name"
        required
    >


    <textarea
        name="message"
        placeholder="Write your Christmas wish..."
        required
    ></textarea>


    <button type="submit">
        Send Wish 🎄
    </button>

</form>


<br>


<a
    href="all_wishes.php"
    class="view-wishes-btn"
>
    💌 View All Christmas Wishes
</a>


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

<!-- JAVASCRIPT -->

<script src="script.js"></script>

</body>

</html>
