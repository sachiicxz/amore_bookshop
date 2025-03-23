<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amore's Bookshop</title>

    <link rel="stylesheet" href="style/main.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<style>
    body {
        background-color: rgb(184, 173, 131);
    }

    .form-control {
        border: 1px solid black;
    }

    .form-label {
        font-weight: bold;
    }

    .buttonS {
        background-color: green;
        color: rgb(255, 255, 255);
        border: 1px solid black;
        width: 30%;
        padding: 10px;
        margin-left: 35%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 13px;
        cursor: pointer;
        border-radius: 5px;
        margin-top: 3%;
        transition: background-color 0.3s, transform 0.2s;
    }

    .buttonS:hover {
        background-color: #0d7a39;
        transform: scale(1.05);
    }

    .feedback-container {
        background: rgb(212, 197, 134);
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        width: 650px;
        border: 1px solid black;
        margin-top: 3%;
        margin-bottom: 3%;
        font-size: 15px;
        width: 50%;
        margin-left: 25%
    }

    .card{
        border: 1px solid #362c09;
        background-color: transparent;
    }
</style>

<body>
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <!-- Logo and Brand -->
            <a class="navbar-brand d-flex align-items-center text-white" href="dashboard.php">
                <img src="https://media4.giphy.com/media/v1.Y2lkPTc5MGI3NjExbzUxZjQ0eWd4NTlwNTJzY2Z4dnhjbHNxeDgwenNyd3FudnZiYTdmayZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/xT8qBt3pdiCZrk3erS/giphy.gif"
                    alt="Amore Bookshop Logo" width="40" height="40" class="me-2">
                Amore Bookshop
            </a>

            <!-- Hamburger Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link active" href="#home">HOME</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about-us">ABOUT US</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">SERVICES</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">CONTACT</a></li>
                </ul>
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    const links = document.querySelectorAll(".nav-link");

                    window.addEventListener("scroll", () => {
                        let scrollPos = window.scrollY;

                        links.forEach((link) => {
                            let section = document.querySelector(link.getAttribute("href"));

                            if (section && section.offsetTop <= scrollPos + 100 && section.offsetTop + section.offsetHeight > scrollPos) {
                                links.forEach((l) => l.classList.remove("active"));
                                link.classList.add("active");
                            }
                        });
                    });
                });
            </script>

            <!-- Search Bar and Logout (Aligned to Right) -->
            <div class="d-flex align-items-center">
                <!-- Search Bar -->
                <form class="d-flex me-2" action="search.php" method="GET">
                    <input type="text" name="query" class="form-control form-control-sm me-2"
                        placeholder="Search Books">
                    <button class="btn btn-outline-dark btn-sm" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </form>

                <!-- Logout Button -->
                <a href="logout.php" onclick="return confirmLogout()" class="buttonO">Logout</a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <!--scriptt-->
    <script>
        function confirmLogout() {
            return confirm("Are you sure you want to logout?");
        }
    </script>

    <div class="container">
        <!--main content start-->
        <div id="" class="hero">
            <div class="row mt-4 mb-4">
                <div class="col">
                    <h2>AMORE'S BOOKSHOP</h2>
                    <hr style="height: 3px; background-color: black; width: 65px; margin:auto; margin-bottom: 3%;">
                </div>

                <div class="header-container">
                    <img src="images/header.jpg" alt="Bookshop Image">
                    <div class="text-overlay1">
                        Welcome to Amore Bookshop! <i class="bi bi-book-half"></i>

                        At Amore Bookshop, we are passionate about bringing the joy of reading to everyone. Whether
                        you're
                        looking for a timeless classic, an exciting new release, or a hidden gem, our collection is
                        carefully selected to cater to all book lovers.

                        We take pride in creating a warm and inviting space where you can explore different worlds, gain
                        new
                        knowledge, and experience the magic of storytelling. Your love for books is at the heart of what
                        we
                        do, and we're always here to help you find the perfect read.

                        Thank you for visiting Amore Bookshop—where every page holds a new adventure!
                    </div>

                </div>
            </div>
        </div>

        <!--home card start-->
        <div id="home" class="home">
            <div class="row mt-4">
                <h3>BOOKS</h3>

                <hr style="height: 3px; background-color: black; width: 65px; margin:auto; margin-bottom: 2%;">

                <!--books-->

                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card">
                            <img src="images/P1.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up
                                    the
                                    bulk
                                    of
                                    the card's content.</p>
                                <a href="#" class="btn-read">Read Book</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card">
                            <img src="images/P2.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up
                                    the
                                    bulk
                                    of
                                    the card's content.</p>
                                <a href="#" class="btn-read">Read Book</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card">
                            <img src="images/PIC3.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up
                                    the
                                    bulk
                                    of
                                    the card's content.</p>
                                <a href="#" class="btn-read">Read Book</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card">
                            <img src="images/P4.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up
                                    the
                                    bulk
                                    of
                                    the card's content.</p>
                                <a href="#" class="btn-read">Read Book</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--more books-->

            <div class="row mt-4 g-4">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card">
                        <img src="images/P5.jpg" class="card-img-top" alt="Book Image">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title.</p>
                            <a href="#" class="btn-read">Read Book</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card">
                        <img src="images/P6.png" class="card-img-top" alt="Book Image">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title.</p>
                            <a href="#" class="btn-read">Read Book</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card">
                        <img src="images/P7.jpg" class="card-img-top" alt="Book Image">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title.</p>
                            <a href="#" class="btn-read">Read Book</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card">
                        <img src="images/P8.jpg" class="card-img-top" alt="Book Image">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title.</p>
                            <a href="#" class="btn-read">Read Book</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div id="about-us" class="about-us">
            <!-- About Us -->
            <div class="row mt-4">
                <div class="col">
                    <h3>ABOUT US</h3>

                    <hr style="height: 3px; background-color: black; width: 65px; margin:auto; margin-bottom: 2%;">


                    <div class="image-container">
                        <img src="https://media0.giphy.com/media/v1.Y2lkPTc5MGI3NjExaTA0dm92NGE0NDYxMWdrNXNpOHFmMTlleHEzMXZkOHQ3a241MXozNCZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/ASE4MTrGlWOzzUIvGm/giphy.gif"
                            alt="Bookshop Image">
                        <div class="text-overlay">
                            Amore Bookshop is a charming and inviting independent bookstore dedicated to fostering a
                            love for reading
                            and literature. Located in the heart of the community, it offers a carefully curated
                            selection of books
                            across various genres, from bestsellers to hidden gems. Whether you're a passionate
                            reader,
                            a casual book lover,
                            or seeking a special gift, Amore Bookshop creates a warm and welcoming atmosphere where
                            every visit feels like
                            an escape into the world of storytelling.
                        </div>

                    </div>
                </div>

                <div id="services" class="services">
                    <!-- Services -->
                    <div class="row mt-4">
                        <div class="col"></div>
                        <h3>SERVICES OFFERED</h3>
                        <hr style="height: 3px; background-color: black; width: 65px; margin:auto; margin-bottom: 2%;">


                        <h5>COMMING SOON!</h5>
                        <br>
                        <p>Welcome to Amore Bookshop! <i class="bi bi-book-half"></i>

                            At Amore Bookshop, you can buy your favorite books to add to your collection or borrow
                            them
                            if you love reading on the go. Whether you're looking for the latest bestsellers,
                            timeless
                            classics,
                            or hidden gems, we have something for every book lover.

                            Visit us today and let your next great story begin! </p>
                    </div>
                </div>

                <div id="contact" class="contact mb-3">
                    <!-- Contact -->
                    <div class="row mt-4">
                        <h3>CONTACT US</h3>

                        <hr style="height: 3px; background-color: black; width: 65px; margin:auto; margin-bottom: 2%;">

                        <p><b>We greatly appreciate your time and effort in sharing your feedback with us.</b> Your
                            thoughts
                            and suggestions help us improve our services and create a better experience for
                            everyone.

                            When providing feedback, we encourage you to be clear and honest. Let us know what you
                            enjoyed and if there are any areas where we can improve. Your input is truly valuable,
                            and
                            we are always eager to learn from your experience.

                            <b>Thank you for helping us grow and serve you better!</b>
                        </p>

                    </div>


                    <div class="feedback-container">
                        <h5 class="mb-3 text-center fw-bold">Feedback Form</h5>
                        <form action="submit_feedback.php" method="POST">

                            <div class="mb-2">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Enter your name (Optional)">
                            </div>

                            <div class="mb-2">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="Enter your email" required>
                            </div>

                            <div class="mb-2">
                                <label for="message" class="form-label">Feedback Message</label>
                                <textarea name="message" id="message" class="form-control" rows="4"
                                    placeholder="Write your feedback" required></textarea>
                            </div>

                            <button type="submit" class="buttonS">Submit Feedback</button>
                        </form>

                    </div>
                    <div class="social-buttons mt-4 mb-2">
                        <a href="https://facebook.com" target="_blank"><i class="bi bi-facebook"></i></a>
                        <a href="https://twitter.com" target="_blank"><i class="bi bi-twitter"></i></a>
                        <a href="https://instagram.com" target="_blank"><i class="bi bi-instagram"></i></a>
                        <a href="https://gmail.com" target="_blank"><i class="bi bi-google"></i></a>
                        <a href="https://linkedin.com" target="_blank"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--footerr-->
    <footer class="bg-dark text-white text-center p-1">
        <p class="mb-0 text-small"><i class="bi bi-geo-alt-fill"></i> 123 Book Street, Cityname | <i
                class="bi bi-telephone-fill"></i> (123)
            456-7890 | <i class="bi bi-envelope-fill"></i> contact@amorebookshop.com</p>
        <p class="text-small mb-0 mt-0">&copy; 2025 Amore Bookshop. All Rights Reserved.</p>
    </footer>


</body>

</html>