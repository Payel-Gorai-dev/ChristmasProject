<?php

session_start();

include "db.php";


/* Login check */

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");

    exit();

}


/* Cart ID এবং Action এসেছে কিনা check */

if (
    !isset($_POST["cart_id"]) ||
    !isset($_POST["action"])
) {

    header("Location: cart.php");

    exit();

}


$user_id = $_SESSION["user_id"];

$cart_id = (int) $_POST["cart_id"];

$action = $_POST["action"];


/* Cart item এই user-এর কিনা check */

$check = $conn->prepare(

    "SELECT quantity
     FROM cart
     WHERE id = ? AND user_id = ?"

);

$check->bind_param(
    "ii",
    $cart_id,
    $user_id
);

$check->execute();

$result = $check->get_result();


if ($result->num_rows > 0) {


    $item = $result->fetch_assoc();

    $quantity = $item["quantity"];


    /* PLUS */

    if ($action === "increase") {

        $quantity++;

    }


    /* MINUS */

    elseif ($action === "decrease") {

        $quantity--;

    }


    /* Quantity 1-এর নিচে গেলে */

    if ($quantity <= 0) {


        $delete = $conn->prepare(

            "DELETE FROM cart
             WHERE id = ? AND user_id = ?"

        );


        $delete->bind_param(
            "ii",
            $cart_id,
            $user_id
        );


        $delete->execute();


    } else {


        /* নতুন Quantity Update */

        $update = $conn->prepare(

            "UPDATE cart
             SET quantity = ?
             WHERE id = ? AND user_id = ?"

        );


        $update->bind_param(
            "iii",
            $quantity,
            $cart_id,
            $user_id
        );


        $update->execute();

    }

}


/* আবার Cart Page */

header("Location: cart.php");

exit();

?>
