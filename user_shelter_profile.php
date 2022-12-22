<?php
include_once("./database/config.php");

session_start();
$username = $_SESSION['username'];

if (!isset($_SESSION['username'])) {
    header("Location: user_login.php");
}

$sql = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);

$id = $_GET['id'];

$sql = "SELECT * FROM shelter WHERE shelter_id='$id'";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);

$name=$row['shelter_name'];
$image=$row['shelter_img'];
$contact=$row['contact'];
$email=$row['email'];
$address=$row['address'];
$city=$row['city'];
$zip=$row['zip'];

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Shelter Profile</title>

  <!-- Google Fonts -->
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">
  <!-- Icon Font Css -->
  <link rel="stylesheet" href="plugins/icofont/icofont.min.css">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- Navbar Start -->
  <?php include_once("./templates/user_header.php");?>
  <!-- Navbar end -->

  <main id="main">
  <section> </section>

    <section class="inner-page">
      <div class="container">
        <div class="section-title">
          <h2>Shelter Profile</h2>
        </div>
        <div class="row">
          <div class="col-lg-7" style="margin-right:50px;">
            <div class="doctor-img-block">
              <img src="assets/img/shelters/<?php echo $image ?>" alt="" class="img-fluid w-100">
            </div>
            <div style="margin-top: 40px;">
              <h3 style="font-weight:700"><?php echo $name ?></h3>
              <div class="divider my-4"></div>
              <p><i class='bx bxs-location-plus' style="font-size:20px;"></i>&nbsp;&nbsp;&nbsp;<?php echo $address." ".$city."-".$zip ?></p>
              <p><i class="fa-solid fa-paw"></i>&nbsp;&nbsp;&nbsp;Cats, Dogs, Rabbits </p>
              <p><i class="fa fa-email"></i> <?php echo $email?></p>
              <p style="padding-top:20px;">We are ensuring you the best services for your pet.</p>

              <a href="user_shelter_animals.php?id=<?php echo $id?>" class="appointment-btn scrollto"
                style="margin:0; padding: 15px 50px; margin-top:20px;">Show Animals</a>


            </div>
          </div>
          <div class="col-lg-4">
            <div class="section-bg" style="padding:30px;">
              <h5 class="mb-4" style="font-weight:700">Make Appointment</h5>

              <ul class="list-unstyled lh-35">
                <li class="d-flex justify-content-between align-items-center" style="padding-bottom:15px;">
                  <a href="#">Monday - Friday</a>
                  <span>9:00 - 17:00</span>
                </li>
                <li class="d-flex justify-content-between align-items-center" style="padding-bottom:15px;">
                  <a href="#">Saturday</a>
                  <span>9:00 - 16:00</span>
                </li>
                <li class="d-flex justify-content-between align-items-center">
                  <a href="#">Sunday</a>
                  <span>Closed</span>
                </li>
              </ul>

              <div class="sidebar-contatct-info mt-4">
                <p class="mb-0">Need Urgent Help?</p>
                <h3 class="text-color-2"><?php echo $contact?></h3>
              </div>
            </div>

            <div class="skill-list" style="margin-top:100px;">
              <h5 class="mb-4" style="font-weight:700">Expertise area</h5>
              <ul class="list-unstyled department-service">
                <li><i class='bx bx-check' style="color:blue; font-size:25px; padding-right:10px;"></i>vaccination</li>
                <li><i class='bx bx-check' style="color:blue; font-size:25px; padding-right:10px;"></i>neuter and spay</li>
                <li><i class='bx bx-check' style="color:blue; font-size:25px; padding-right:10px;"></i>gromming</li>
                <li><i class='bx bx-check' style="color:blue; font-size:25px; padding-right:10px;"></i>Foster home</li>
                <li><i class='bx bx-check' style="color:blue; font-size:25px; padding-right:10px;"></i>accessories</li>
                <li><i class='bx bx-check' style="color:blue; font-size:25px; padding-right:10px;"></i>Emergency home checkup</li>
              </ul>

              <div style="margin-top:50px;">
                <ul class="list-inline mt-4 social-links">
                  <li class="list-inline-item"><a href="#"><i class='bx bxl-facebook' style="font-size:30px;"></i></a>
                  </li>
                  <li class="list-inline-item"><a href="#"><i class='bx bxl-twitter' style="font-size:30px;"></i></a>
                  </li>
                  <li class="list-inline-item"><a href="#"><i class='bx bxl-skype' style="font-size:30px;"></i></a></li>
                  <li class="list-inline-item"><a href="#"><i class='bx bxl-linkedin' style="font-size:30px;"></i></a>
                  </li>
                  <li class="list-inline-item"><a href="#"><i class='bx bxl-pinterest' style="font-size:30px;"></i></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- footer Start -->
  <?php include_once("./templates/footer.php");?>
  <!-- footer end -->


  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>