<?php

session_start();

include "db.php";

if (isset($_SESSION["user_id"])) {

    $user_id = $_SESSION["user_id"];

    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    $stmt->close();
}

/* Account delete হওয়ার পরে session শেষ */
session_unset();
session_destroy();

/* Register page-এ পাঠাবে */
header("Location: register.php");

exit();

?>
