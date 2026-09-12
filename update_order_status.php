<?php
session_start();
include "db.php";

/* Only Admin */

if (!isset($_SESSION["user_id"]) || !isset($_SESSION["is_admin"]) || $_SESSION["is_admin"] != 1) {
    header("Location: login.php");
    exit();
}

if (!isset($_POST["order_id"]) || !isset($_POST["order_status"])) {
    header("Location: admin_dashboard.php");
    exit();
}

$order_id = (int) $_POST["order_id"];

$allowed_statuses = ["Pending", "Shipped", "Delivered", "Cancelled"];
$order_status = $_POST["order_status"];

if (!in_array($order_status, $allowed_statuses)) {
    header("Location: admin_dashboard.php");
    exit();
}

$stmt = $conn->prepare("UPDATE orders SET order_status = ? WHERE id = ?");
$stmt->bind_param("si", $order_status, $order_id);
$stmt->execute();

header("Location: admin_dashboard.php");
exit();
?>