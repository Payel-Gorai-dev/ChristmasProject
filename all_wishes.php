<?php
include "db.php";

$sql = "SELECT * FROM wishes ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

```
<title>Christmas Wishes</title>

<link rel="stylesheet" href="christmas.css">
```

</head>

<body>

```
<div class="snow"></div>

<nav class="navbar">
    <div class="logo">🎄 Christmas</div>

    <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="index.php#about">About</a></li>
        <li><a href="index.php#gifts">Gifts</a></li>
        <li><a href="index.php#wishes">Send Wishes</a></li>
    </ul>
</nav>


<section class="all-wishes-section">

    <h1>Christmas Wishes From Everyone 💌🎄</h1>

    <p class="wish-subtitle">
        Share the joy, love and magic of Christmas! ❤️
    </p>


    <div class="wishes-container">

        <?php

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {

                echo '<div class="wish-card">';

                echo '<div class="wish-card-icon">🎄</div>';

                echo '<h3>' . htmlspecialchars($row["name"]) . '</h3>';

                echo '<p>' . htmlspecialchars($row["message"]) . '</p>';

                echo '<span>✨ Merry Christmas!</span>';

                echo '</div>';
            }

        } else {

            echo '<p class="no-wishes">No wishes yet. Be the first to send one! 🎁</p>';

        }

        ?>

    </div>

</section>


<footer>

    <p>🎄 Merry Christmas & Happy New Year 🎆</p>

    <p>Made with ❤️ for Christmas Celebration</p>

</footer>

</body>
</html>
