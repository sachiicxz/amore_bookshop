<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);

    // Check if the email exists in the database
    $checkEmail = "SELECT * FROM users WHERE email=?";
    $stmt = $conn->prepare($checkEmail);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Normally, you'd send an email with a reset link. For now, just display a success message.
        $success = "A password reset link has been sent to your email.";
    } else {
        $error = "Email address not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amore's Bookshop</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<style>
    *,
    *::before,
    *::after {
        box-sizing: border-box;
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    }

    body {
        background-color: rgb(184, 173, 131);
    }

    .forgot-container h2 {
       text-align: center;        
       font-size: 1.6rem;
        font-weight: bold;
        margin-bottom: 7%;
    }

    .forgot-container p {
        font-size: 0.9rem;
        margin-bottom: 5px;
    }

    .forgot-container {
        max-width: 350px;
        background: rgb(161, 147, 91);
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        margin-top: 3%;
        border: 1px solid black;
    }

    .btn-reset {
        background-color: rgb(3, 126, 24);
        color: rgb(255, 255, 255);
        border: 1px solid black;
        width: 50%;
        padding: 10px;
        margin-left: 25%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 13px;
        cursor: pointer;
        border-radius: 5px;
        transition: background-color 0.3s, transform 0.2s;
    }

    .btn-reset:hover {
        background-color: rgb(19, 73, 6);
        color: white;
        transform: scale(1.05);
        border: 1px solid black;
    }

    .form-control {
        border: 1px solid black;
        border-radius: 5px;
    }

    .form-label {
        margin-top: 5%;
        font-weight: bold;
    }

    .b2login {
        font-size: 0.9rem;
        margin-top: 5%;
        text-align: center;
    }
</style>

<body class="d-flex justify-content-center align-items-center vh-100">

    <div class="forgot-container">
        <h2>Forgot Password</h2>

        <p class="text-muted">Enter your email to receive reset instructions</p>

        <?php if (isset($error)) {
            echo "<div class='alert alert-danger'>$error</div>";
        } ?>
        <?php if (isset($success)) {
            echo "<div class='alert alert-success'>$success</div>";
        } ?>

        <form action="" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email"
                    required>
            </div>

            <button type="submit" class="btn btn-reset">Send Reset Link</button>
        </form>

        <p class="b2login">
            <a href="login.php" class="text-decoration-none">Back to Login</a>
        </p>
    </div>

</body>

</html>