<?php
include_once("./database/config.php");

$username = $_SESSION['vetname'];

$sql = "SELECT * FROM `vets` WHERE username='$username'";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);

$img=$row['image'];

?>

<!-- ======= Top Bar ======= -->
<div id="topbar" class="d-flex align-items-center fixed-top" style="background:#f1f7fd">
    <div class="container d-flex justify-content-between">
        <div class="contact-info d-flex align-items-center">
            <i class="bi bi-envelope"></i> <a href="mailto:animadoption@gmail.com">animadoption@gmail.com</a>
            <i class="bi bi-phone"></i> +880 1315609784
        </div>
        <div class="d-none d-lg-flex social-links align-items-center">
            <a href="vet_profile.php" class="facebook"><i class="fas fa-user"></i> &nbsp;&nbsp;My Profile</i></a>
            <a href="logout.php" class="twitter"><i class="fas fa-sign-out"></i> &nbsp;&nbsp;Logout</a>
        </div>
    </div>
</div>
<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">
        <h1 class="logo me-auto"><a href="vet_home.php">Animadoption</a></h1>
        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                <li><a class="nav-link scrollto" href="vet_home.php">Home</a></li>
                <li><a class="nav-link scrollto" href="vet_appointments.php">My Appointments</a></li>
                <li><a class="nav-link scrollto" href="vet_appointment_history.php">Appointment History</a></li>
                <li><a class="nav-link scrollto" href="vet_patients.php">Patients History</a></li>

            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

        <a class="dropdown-toggle" href="#" style="color:white; font-weight:500" role="button">

            <img src="./assets/img/doctors/<?php echo $img?>" class="rounded-circle" height="40" alt="" loading="lazy"
                style="margin-left:60px;" /> &nbsp;&nbsp; <span
                style="color:black;font-weight: 600;font-family: 'Exo', sans-serif;text-transform: capitalize; font-size:16px;"><?php echo $username?></span>
        </a>
    </div>
</header><!-- End Header -->