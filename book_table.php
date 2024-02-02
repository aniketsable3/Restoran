<?php

$showAlert = false;
$login = false;
$showError = false;
$exists = false;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    include "dbconnect.php";

    $name = $_POST['name'];
    $email = $_POST['email'];
    $dt = isset($_POST['dt']) ? $_POST['dt'] : '';
    $formattedDate = date('Y-m-d H:i:s', strtotime($dt));
    $people = $_POST['people'];
    $mobileno = $_POST['mobileno'];
    $request = $_POST['request'];
    $btable = $_POST['btable'];

    // Check if an entry with the same number of people already exists
    $checkSql = "SELECT * FROM `book` WHERE btable = '$btable' OR dt='$formattedDate'";
    $checkResult = mysqli_query($conn, $checkSql);
    $numExistRows = mysqli_num_rows($checkResult);

    if ($numExistRows > 0) {
        $exists = true;
        $showError ="Entry with. $people. people already exists on $formattedDate";
    } else {
        // Insert a new record if no entry with the same number of people exists
        $sql = "INSERT INTO `book` (`name`, `email`, `dt`, `mobileno`, `request`, `people`,`btable`) VALUES ('$name', '$email', '$formattedDate', '$mobileno', '$request', '$people','$btable')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $showAlert = true;
            
            // Redirect after successful form submission
           
        } else {
            $showError = "Error: " . mysqli_error($conn);
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    include "dbconnect.php";
    $btable = $_POST['btable'];

    $sql = "SELECT * FROM `book` WHERE btable='$btable' AND dt='$formattedDate'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if ($num == 1) {
        $login = true;
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['btable'] = $btable;
        $_SESSION['dt'] = $formattedDate;
    } else {
        $showError = "Invalid Credentials";
    }
}

// Rest of your code...



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'D:\xampp\htdocs\woo\PHPMailer-master\src/Exception.php';
require 'D:\xampp\htdocs\woo\PHPMailer-master\src/SMTP.php';
require 'D:\xampp\htdocs\woo\PHPMailer-master\src/PHPMailer.php';
require __DIR__ . '/vendor/autoload.php';
    if ($showAlert) {
    
    
        if (isset($_POST["submit"])) {
            $name=$_POST['name'];
            $email=$_POST['email'];
            $dt=$_POST['dt'];
            $people=$_POST['people'];
            $mobileno=$_POST['mobileno'];
            $request=$_POST['request'];
            $btable=$_POST['btable'];
            // Assuming these variables are defined elsewhere
            $subject = "Welcome To Restoran";
            $body = "Congratulations ". $name. " Your table for ".$people." people has been booked on the date /".$dt."On table Number ".$btable." We hope you have an exciting day .
            Thank you";
        
            $mail= new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host='smtp.gmail.com';
            $mail->SMTPAuth=true;
            $mail->Username='aniketsable0508@gmail.com';
            $mail->Password='wqzsthfaaiqeqsph';  
            $mail->SMTPSecure='ssl';
            $mail->Port=465;
        
            $mail->setFrom('aniketsable0508@gmail.com');
            $mail->addAddress($_POST["email"]);
        
            $mail->isHTML(true);
        
            // Use the defined variables for subject and body
            $mail->Subject = $subject;
            $mail->Body = $body;
        
            $mail->send();
        
            echo "
            <script> alert('Your Table Is Been Booked Successfully.Kindly check Your Mailbok');
            
            </script>
            ";
    }

        
    //   $sid = "AC735140c2dc8522f59556656a5ea9db96";
    //   $token = "27520626abea33645bb1221e9d84797a";
    //   $client = new Twilio\Rest\Client($sid, $token);

    //   $message = $client->messages->create(
    //       '+919423553920',
    //       [
    //           'from' => '+12028310581',
    //           'body' => "Congratulations ". $name. " Your table for ".$people." people has been booked on the date /".$dt."On table Number ".$btable." We hope you have an exciting day .
    //           Thank you
    //           "
    //       ]
    //   );



 }



?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link href="img/favicon.ico" rel="icon">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <title>Booking Table</title>
    <style>
    body {
        background-color: black;


    }

    #h1 {
        font-size: 3rem;
    }
    </style>
  
    
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
        <a href="main.php" class="navbar-brand p-0">
            <h1 class="text-primary m-0"><i class="fa fa-utensils me-3"></i>Restoran</h1>
            <!-- <img src="img/logo.png" alt="Logo"> -->
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0 pe-4">
                <a href="main.php" class="nav-item nav-link active">Home</a>
                <a href="about.php" class="nav-item nav-link">About</a>
                <a href="service.php" class="nav-item nav-link">Service</a>
                <a href="menu.php" class="nav-item nav-link">Menu</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu m-0">
                        <a href="booking.php" class="dropdown-item">Booking</a>
                        <a href="team.php" class="dropdown-item">Our Team</a>
                        <a href="testimonial.php" class="dropdown-item">Testimonial</a>
                    </div>
                </div>
                <a href="contact.php" class="nav-item nav-link">Contact</a>
            </div>
            <a href="" class="btn btn-primary py-2 px-4">Book A Table</a>
        </div>
    </nav>
    </div>
    <?php
    if ($login) {
    echo "<script>alert('The table is been booked') </script>";
  }
  ?>
  
    <?php 
    
    if ($exists) {
    
        echo '<script> alert("Entry with ' . $btable . ' people already exists on '.$formattedDate.'");</script>';
        // Change 'success.php' to your desired success page
        exit();
    }
    ?>

    <!-- Reservation Start -->
    <div class="container-xxl py-5 px-0 wow fadeInUp mt-5   " data-wow-delay="0.1s">
        <div class="row g-0">
            <div class="col-md-6">
                <div class="video">
                    <button type="button" data-bs-toggle="modal" data-src="https://www.youtube.com/embed/DWRcNpR6Kdc"
                        data-bs-target="#videoModal">
                        <span></span>
                    </button>
                </div>
            </div>
            <div class="col-md-6 bg-dark d-flex align-items-center">
                <div class="p-5 wow fadeInUp" data-wow-delay="0.2s">
                    <h5 class="section-title ff-secondary text-start text-primary fw-normal">Reservation</h5>
                    <h1 class="text-white mb-4">Book A Table Online</h1>
                    <form action="" method="post" id="reservationForm">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="Your Name" required>
                                    <label for="name">Your Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Your Email" required>
                                    <label for="email">Your Email</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating date" id="date3" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" name="dt" id="datetime"
                                        placeholder="Date & Time" data-target="#date3" data-toggle="datetimepicker" />
                                    <label for="datetime">Date & Time</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="select1" name="people" required>
                                        <option value="1">People 1</option>
                                        <option value="2">People 2</option>
                                        <option value="3">People 3</option>
                                    </select>
                                    <label for="select1">No Of People</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <select class="form-select" id="select1" name="btable">
                                        <option value="1">Table 1</option>
                                        <option value="2">Table 2</option>
                                        <option value="3">Table 3</option>
                                        <option value="4">Table 4</option>
                                        <option value="5">Table 5</option>
                                        <option value="6">Table 6</option>
                                        <option value="7">Table 7</option>
                                        <option value="8">Table 8</option>
                                        <option value="9">Table 9</option>
                                        <option value="10">Table 10</option>
                                        
                                    </select>
                                    <label for="select1">No Of People</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="mobileno" id="number"
                                        placeholder="Your Mobile No" required>
                                    <label for="number">Your Number</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Special Request" name="request"
                                        id="message" style="height: 100px"></textarea>
                                    <label for="message">Special Request</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit" name="submit" id="submitBtn">Book Now</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Company</h4>
                    <a class="btn btn-link" href="">About Us</a>
                    <a class="btn btn-link" href="">Contact Us</a>
                    <a class="btn btn-link" href="">Reservation</a>
                    <a class="btn btn-link" href="">Privacy Policy</a>
                    <a class="btn btn-link" href="">Terms & Condition</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Contact</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Opening</h4>
                    <h5 class="text-light fw-normal">Monday - Saturday</h5>
                    <p>09AM - 09PM</p>
                    <h5 class="text-light fw-normal">Sunday</h5>
                    <p>10AM - 08PM</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Newsletter</h4>
                    <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control border-primary w-100 py-3 ps-4 pe-5" type="text"
                            placeholder="Your email" required>
                        <button type="button"
                            class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">Your Site Name</a>, All Right Reserved.

                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a><br><br>
                        Distributed By <a class="border-bottom" href="https://themewagon.com"
                            target="_blank">ThemeWagon</a>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="footer-menu">
                            <a href="">Home</a>
                            <a href="">Cookies</a>
                            <a href="">Help</a>
                            <a href="">FQAs</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->
    


    <!-- Back to Top -->

    </div>

    <!-- JavaScript Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <script>
        $(document).ready(function () {
            $("#submitBtn").on("click", function () {
                var formData = $("#reservationForm").serialize();

                $.ajax({
                    type: "POST",
                    url: "book_tabl.php", // Update with the path to your PHP script
                    data: formData,
                    success: function (response) {
                        alert(response);
                        // You can handle the response here, like showing a success message or updating the UI.
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
