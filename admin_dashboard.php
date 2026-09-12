<?php
session_start();
include "db.php";

/* শুধু Admin-দের জন্য */

if (!isset($_SESSION["user_id"]) || !isset($_SESSION["is_admin"]) || $_SESSION["is_admin"] != 1) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM orders ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #0d1b0d;
            color: white;
        }

        nav {
            background: #b30000;
            padding: 18px 8%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav h2 {
            color: white;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
        }

        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .container h1 {
            color: #ffd700;
            margin-bottom: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: rgba(255,255,255,0.05);
            border-radius: 12px;
            overflow: hidden;
        }

        th, td {
            padding: 14px;
            text-align: left;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            font-size: 15px;
        }

        th {
            background: rgba(255,215,0,0.15);
            color: #ffd700;
        }

        select {
            padding: 8px;
            border-radius: 6px;
            border: none;
        }

        button {
            padding: 8px 14px;
            border: none;
            border-radius: 6px;
            background: #087f23;
            color: white;
            cursor: pointer;
            margin-left: 8px;
        }

        button:hover {
            background: #0aa52d;
        }

        .no-orders {
            text-align: center;
            padding: 40px;
        }

    </style>

</head>
<body>

<nav>
    <h2>🎄 Admin Dashboard</h2>
    <div>
        <a href="index.php">Home</a>
        <a href="logout.php">Logout</a>
    </div>
</nav>

<div  class="container">

    <h1>📦 All Orders</h1>

    <?php if ($result->num_rows > 0) { ?>

        <table>
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Total</th>
                <th>Status</th>
                <th>Update</th>
            </tr>

            <?php while ($order = $result->fetch_assoc()) { ?>

                <tr>
                    <td>#<?php echo $order["id"]; ?></td>
                    <td><?php echo htmlspecialchars($order["customer_name"]); ?></td>
                    <td><?php echo htmlspecialchars($order["phone"]); ?></td>
                    <td><?php echo htmlspecialchars($order["address"]); ?></td>
                    <td>₹<?php echo number_format($order["total_amount"], 2); ?></td>
                    <td><?php echo htmlspecialchars($order["order_status"]); ?></td>
                    <td>
                        <form action="update_order_status.php" method="POST" style="display:flex; align-items:center;">
                            <input type="hidden" name="order_id" value="<?php echo $order["id"]; ?>">
                            <select name="order_status">
                                <option value="Pending" <?php echo $order["order_status"] == "Pending" ? "selected" : ""; ?>>Pending</option>
                                <option value="Shipped" <?php echo $order["order_status"] == "Shipped" ? "selected" : ""; ?>>Shipped</option>
                                <option value="Delivered" <?php echo $order["order_status"] == "Delivered" ? "selected" : ""; ?>>Delivered</option>
                                <option value="Cancelled" <?php echo $order["order_status"] == "Cancelled" ? "selected" : ""; ?>>Cancelled</option>
                            </select>
                            <button type="submit">Update</button>
                        </form>
                    </td>
                </tr>

            <?php } ?>

        </table>

    <?php } else { ?>

        <div class="no-orders">No orders yet.</div>

    <?php } ?>

</div>

</body>
</html>