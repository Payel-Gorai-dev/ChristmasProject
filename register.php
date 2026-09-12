<?php
session_start();
include "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        $message = "This email is already registered!";
    } else {

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare(
            "INSERT INTO users (name, email, password) VALUES (?, ?, ?)"
        );

        $stmt->bind_param("sss", $name, $email, $hashedPassword);

        if ($stmt->execute()) {
            header("Location: login.php?registered=1");
            exit();
        } else {
            $message = "Registration failed. Please try again!";
        }
    }
}
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>Register - Christmas Celebration</title>

<link rel="stylesheet" href="christmas.css">

</head>

<body>


<div class="snow"></div>

<div class="auth-container">

    <div class="auth-box">

        <h1>🎄 Create Account</h1>

        <p>Join the Christmas Celebration!</p>

        <?php
        if ($message != "") {
            echo '<p class="auth-message">' . $message . '</p>';
        }
        ?>

        <form method="POST">

            <input
                type="text"
                name="name"
                placeholder="Enter your name"
                required
            >

            <input
                type="email"
                name="email"
                placeholder="Enter your email"
                required
            >

            <input
                type="password"
                name="password"
                placeholder="Create a password"
                required
            >

            <button type="submit">Register 🎁</button>

        </form>

        <p class="auth-link">
            Already have an account?
            <a href="login.php">Login here</a>
        </p>

        <a href="index.php" class="back-home">← Back to Home</a>

    </div>

</div>


</body>
</html>
