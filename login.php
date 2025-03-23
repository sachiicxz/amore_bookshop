<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) { // Secure password verification
            $_SESSION['username'] = $username;
            echo "<script>alert('Account Login successfully'); window.location.href='dashboard.php';</script>";
            exit();
        } else {
            $error = "Invalid username or password! Please try again.";
        }
    } else {
        $error = "Invalid username or password!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amore's Bookshop</title>

    <link rel="stylesheet" href="style/LOGIN.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<!--dito na ako nag style ng background color-->
<style>
    body {
        background-color: rgb(184, 173, 131);
    }

    .form-control {
        margin-bottom: 15px;
        width: 100%;
        border: 1px solid black;
    }
</style>

<body class="d-flex flex-column justify-content-center align-items-center">

    <div class="login-container p-4;">

        <div class="row">
            <h2 class="text-center mb-3 fw-bold mt-4">Account Login</h2>

            <?php if (isset($error)) {
                echo "<div class='alert alert-danger'>$error</div>";
            } ?>

            <form action="" method="POST">
                <label for="username" class="form-label">Username</label>
                <div class="mb-3">
                    <input type="text" name="username" class="form-control" placeholder="Enter Username" required>
                </div>

                <label for="password" class="form-label">Password</label>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
                    <p class="text-end small"><a href="forgotpass.php" class="text-decoration-none">Forgot Password?</a>
                    </p>
                </div>

                <button type="submit" class="buttonL mb-3">Login Account</button>
            </form>
            <div>
                </p>
                <p class="text-center small">Don't Have an Account? <span><a href="register.php"
                            class="text-small text-decoration-none">Register
                            Here!</a></span></p>
            </div>

            <div class="text-center d-flex align-items-center justify-content-center">
                <hr class="flex-grow-1 mx-2">
                <p class="small mb-0">Or Login With</p>
                <hr class="flex-grow-1 mx-2">
            </div>

            <div class="text-center">
                <button class="btn btn-gmail"><i class="bi bi-google"></i></button>
            </div>



        </div>
    </div>


</body>

</html>