<?php
session_start();
include "db.php";

$message = "";

if (isset($_GET["registered"])) {
    $message = "Registration successful! Please login.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    $stmt = $conn->prepare(
        "SELECT id, name, password, is_admin FROM users WHERE email = ?"
    );

    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {

        $user = $result->fetch_assoc();

        if (password_verify($password, $user["password"])) {

            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_name"] = $user["name"];
            $_SESSION["is_admin"] = $user["is_admin"];

            if ($user["is_admin"] == 1) {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: index.php");
            }
            exit();

        } else {
            $message = "Incorrect password!";
        }

    } else {
        $message = "No account found with this email!";
    }
}
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>Login - Christmas Celebration</title>

<link rel="stylesheet" href="christmas.css">


</head>

<body>

<div class="snow"></div>

<div class="auth-container">

    <div class="auth-box">

        <h1>🎅 Welcome Back!</h1>

        <p>Login to continue the celebration.</p>

        <?php
        if ($message != "") {
            echo '<p class="auth-message">' . $message . '</p>';
        }
        ?>

        <form method="POST">

            <input
                type="email"
                name="email"
                placeholder="Enter your email"
                required
            >

            <input
                type="password"
                name="password"
                placeholder="Enter your password"
                required
            >

            <button type="submit">Login 🎄</button>

        </form>

        <p class="auth-link">
            Don't have an account?
            <a href="register.php">Create Account</a>
        </p>

        <a href="index.php" class="back-home">← Back to Home</a>

    </div>

</div>


</body>
</html>
