<?php

session_start();

include "db.php";


/* Login check */

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");

    exit();

}


/* Cart ID check */

if (!isset($_POST["cart_id"])) {

    header("Location: cart.php");

    exit();

}


$user_id = $_SESSION["user_id"];

$cart_id = (int) $_POST["cart_id"];


/* Only My Cart Item delete  */

$stmt = $conn->prepare(

    "DELETE FROM cart
     WHERE id = ? AND user_id = ?"

);


$stmt->bind_param(

    "ii",

    $cart_id,

    $user_id

);


$stmt->execute();


$stmt->close();


/* Again Cart Page */

header("Location: cart.php");

exit();

?>
