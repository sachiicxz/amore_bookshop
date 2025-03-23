<?php
session_start();
include "db.php"; // Ensure this is correct

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);


    // Check if username already exists
    $checkUser = "SELECT * FROM users WHERE username=?";
    $stmt = $conn->prepare($checkUser);

    if (!$stmt) {  // Debugging: Check if the statement is prepared correctly
        die("Query failed: " . $conn->error);
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $error = "Username already taken! Please try another one.";
    } else {
        // Insert user into database
        $insertUser = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $conn->prepare($insertUser);

        if (!$stmt) {  // Debugging: Check if the statement is prepared correctly
            die("Query failed: " . $conn->error);
        }

        $stmt->bind_param("ss", $username, $password);

        if ($stmt->execute()) {
            $_SESSION['username'] = $username;
            echo "<script>alert('Account Registered successfully'); window.location.href='dashboard.php';</script>";
            exit();
        } else {
            $error = "Account Registration failed!";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amore's Bookshop</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/register.css">

</head>


<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
                <div class="register-container">

                    <h2 class="text-center mb-3 fw-bold">Account Registration</h2>
                    <hr style="height: 3px; background-color: black; border: none;">
                    <h4 class="text-start fw-bold mb-3">Personal Information</h4>

                    <!-- Error Message -->
                    <?php if (isset($error)) {
                        echo "<div class='alert alert-danger'>$error</div>";
                    } ?>

                    <form action="" method="POST" onsubmit="return validateForm()">
                        <div class="row">
                            <div class="col-5">
                                <div class="mb-3">
                                    <label for="lastname" class="form-label">Last Name</label>
                                    <input type="text" name="lastname" id="lastname" class="form-control"
                                        placeholder="Enter last name" required>
                                    <div class="invalid-feedback">Please enter your last name!</div>
                                </div>
                            </div>

                            <div class="col-5">
                                <div class="mb-3">
                                    <label for="firstname" class="form-label">First Name</label>
                                    <input type="text" name="firstname" id="firstname" class="form-control"
                                        placeholder="Enter first name" required>
                                    <div class="invalid-feedback">Please enter your first name!</div>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="mb-3">
                                    <label for="mi" class="form-label">M.I</label>
                                    <input type="text" name="mi" id="mi" class="form-control" placeholder="M.I">
                                    <div class="invalid-feedback">Please enter your middle initial!</div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="Enter email address" required>
                                </div>
                                <div class="invalid-feedback">Please enter a valid email address!</div>
                            </div>

                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="number" name="phone" id="phone" class="form-control"
                                        placeholder="Enter phone number" required>
                                    <div class="invalid-feedback">Please enter a valid phone number!</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" name="address" id="address" class="form-control"
                                        placeholder="Enter your address" required>
                                    <div class="invalid-feedback">Please enter your address!</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="dob" class="form-label">Date of Birth</label>
                                    <input type="date" name="dob" id="dob" class="form-control" required
                                        onchange="calculateAge()">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="age" class="form-label">Age</label>
                                    <input type="number" name="age" id="age" class="form-control"
                                        placeholder="Enter your age" required readonly>
                                    <div id="age-error" class="invalid-feedback" style="display: none;">You must
                                        be
                                        at least 15 years old to register.</div>
                                </div>
                            </div>

                            <div class="col-4">
                                <label for="gender" class="form-label">Gender</label>
                                <div class="mb-3 d-flex flex-wrap">
                                    <div class="form-check me-4">
                                        <input type="radio" id="male" name="gender" value="male"
                                            class="form-check-input" required>
                                        <label for="male" class="form-check-label">Male</label>
                                    </div>
                                    <div class="form-check me-4">
                                        <input type="radio" id="female" name="gender" value="female"
                                            class="form-check-input" required>
                                        <label for="female" class="form-check-label">Female</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" id="others" name="gender" value="others"
                                            class="form-check-input" required>
                                        <label for="others" class="form-check-label">Others</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--script-->
                        <script>
                            function calculateAge() {
                                const dobInput = document.getElementById("dob");
                                const ageInput = document.getElementById("age");
                                const ageError = document.getElementById("age-error");

                                if (dobInput.value) {
                                    const dob = new Date(dobInput.value);
                                    const today = new Date();
                                    let age = today.getFullYear() - dob.getFullYear();
                                    const monthDiff = today.getMonth() - dob.getMonth();
                                    const dayDiff = today.getDate() - dob.getDate();

                                    if (monthDiff < 0 || (monthDiff === 0 && dayDiff < 0)) {
                                        age--;
                                    }

                                    ageInput.value = age;

                                    if (age < 15) {
                                        ageError.style.display = "block";
                                        dobInput.classList.add("is-invalid");
                                    } else {
                                        ageError.style.display = "none";
                                        dobInput.classList.remove("is-invalid");
                                    }
                                }
                            }

                            function validateForm() {
                                const age = document.getElementById("age").value;
                                const dob = document.getElementById("dob");
                                const password = document.getElementById("password");
                                const confirmPassword = document.getElementById("confirm_password");
                                const passwordError = document.querySelector("#password + .invalid-feedback");
                                const confirmPasswordError = document.querySelector("#confirm_password + .invalid-feedback");
                                const ageError = document.getElementById("age-error");

                                const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
                                let valid = true;

                                // Age Validation
                                if (age < 15) {
                                    ageError.style.display = "block";
                                    dob.classList.add("is-invalid");
                                    valid = false;
                                } else {
                                    ageError.style.display = "none";
                                    dob.classList.remove("is-invalid");
                                }

                                // Password Validation
                                if (!passwordPattern.test(password.value)) {
                                    passwordError.style.display = "block";
                                    password.classList.add("is-invalid");
                                    valid = false;
                                } else {
                                    passwordError.style.display = "none";
                                    password.classList.remove("is-invalid");
                                }

                                // Confirm Password Validation
                                if (password.value !== confirmPassword.value) {
                                    confirmPasswordError.style.display = "block";
                                    confirmPassword.classList.add("is-invalid");
                                    valid = false;
                                } else {
                                    confirmPasswordError.style.display = "none";
                                    confirmPassword.classList.remove("is-invalid");
                                }

                                return valid; // Prevents form submission if false
                            }
                        </script>


                        <h4 class="text-start fw-bold mb-3">Account Information</h4>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" name="username" id="username" class="form-control"
                                        placeholder="Enter your username" required>
                                    <div class="invalid-feedback">Please enter a valid username!</div>
                                </div>

                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="Enter your password" required>
                                    <div class="invalid-feedback">Password must be at least 8 characters long,
                                        contain at least one uppercase letter, one lowercase letter, one number,
                                        and
                                        one special character.</div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mb-">
                                    <label for="confirm_password" class="form-label">Confirm Password</label>
                                    <input type="password" name="confirm_password" id="confirm_password"
                                        class="form-control" placeholder="Confirm your password" required>
                                    <div class="invalid-feedback">Passwords do not match!</div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="buttonR">Register</button>
                            <p class="text-center mt-4">Already have an account? <span><a href="login.php" class="text-decoration-none">Click
                                        Here To Login.</a></span></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>