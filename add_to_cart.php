<?php

session_start();

include "db.php";

/* User login check */

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");

    exit();
}


/* Gift ID check */

if (!isset($_POST["gift_id"])) {

    header("Location: gifts.php");

    exit();
}


$user_id = $_SESSION["user_id"];

$gift_id = (int) $_POST["gift_id"];


/* Previous Gift cart-check */

$check = $conn->prepare(
    "SELECT id, quantity FROM cart WHERE user_id = ? AND gift_id = ?"
);

$check->bind_param("ii", $user_id, $gift_id);

$check->execute();

$result = $check->get_result();


if ($result->num_rows > 0) {

    /* If Previous have quantity 1 increase */

    $cart_item = $result->fetch_assoc();

    $new_quantity = $cart_item["quantity"] + 1;


    $update = $conn->prepare(
        "UPDATE cart SET quantity = ? WHERE id = ?"
    );

    $update->bind_param(
        "ii",
        $new_quantity,
        $cart_item["id"]
    );

    $update->execute();


} else {

    /* New Gift cart- add */

    $insert = $conn->prepare(
        "INSERT INTO cart (user_id, gift_id, quantity)
         VALUES (?, ?, 1)"
    );

    $insert->bind_param(
        "ii",
        $user_id,
        $gift_id
    );

    $insert->execute();
}


/* Go to Cart Page*/

header("Location: cart.php");

exit();

?>
