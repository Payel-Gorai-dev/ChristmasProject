<?php

session_start();

include "db.php";


/* =========================
   LOGIN CHECK
========================= */

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    exit();

}


$user_id = $_SESSION["user_id"];


/* =========================
   FORM DATA CHECK
========================= */

if (
    !isset($_POST["customer_name"]) ||
    !isset($_POST["phone"]) ||
    !isset($_POST["address"])
) {

    header("Location: checkout.php");
    exit();

}


/* =========================
   GET FORM DATA
========================= */

$customer_name = trim($_POST["customer_name"]);

$phone = trim($_POST["phone"]);

$address = trim($_POST["address"]);


/* =========================
   CART থেকে TOTAL আবার Calculate
   নিরাপত্তার জন্য hidden input বিশ্বাস করছি না
========================= */

$sql = "
    SELECT
        cart.quantity,
        gifts.price
    FROM cart
    INNER JOIN gifts
    ON cart.gift_id = gifts.id
    WHERE cart.user_id = ?
";


$stmt = $conn->prepare($sql);

$stmt->bind_param("i", $user_id);

$stmt->execute();

$result = $stmt->get_result();


$total_amount = 0;


/* Cart Empty হলে */

if ($result->num_rows == 0) {

    header("Location: cart.php");
    exit();

}


/* Total Calculate */

while ($row = $result->fetch_assoc()) {

    $total_amount +=
        $row["quantity"] *
        $row["price"];

}


/* =========================
   ORDER DATABASE-এ SAVE
========================= */

$insert = $conn->prepare(

    "INSERT INTO orders
    (
        user_id,
        customer_name,
        phone,
        address,
        total_amount
    )
    VALUES (?, ?, ?, ?, ?)"

);


$insert->bind_param(

    "isssd",

    $user_id,
    $customer_name,
    $phone,
    $address,
    $total_amount

);


$insert->execute();


/* নতুন Order ID */

$order_id = $conn->insert_id;


/* =========================
   CART EMPTY
========================= */

$delete_cart = $conn->prepare(

    "DELETE FROM cart
     WHERE user_id = ?"

);


$delete_cart->bind_param(

    "i",

    $user_id

);


$delete_cart->execute();


/* =========================
   SUCCESS PAGE-এ পাঠাবে
========================= */

header(

    "Location: order_success.php?order_id=" . $order_id

);

exit();

?>
