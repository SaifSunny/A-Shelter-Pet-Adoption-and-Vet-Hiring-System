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


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Shelters</title>

  <!-- Google Fonts -->
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

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
          <h2>Our Shelters</h2>
        </div>
        <div class="row">
          <?php
            $sql = "SELECT * FROM shelter WHERE `verified` ='1'";
            $result = mysqli_query($conn, $sql);
            if($result){
              while($row=mysqli_fetch_assoc($result)){
                                  
                $name=$row['shelter_name'];
                $address=$row['address'] ." ". $row['city']."-". $row['zip'];;
                $image=$row['shelter_img'];
                $contact=$row['contact'];
                $email=$row['email'];
                $shelter_id=$row['shelter_id'];
          ?>
          <div class="col-md-4 form-group ">
            <div class="department-block mb-5 card" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2)">
              <a href="user_shelter_profile.php?id=<?php echo $shelter_id?>"><img src="assets/img/shelters/<?php echo $image?>" alt=""
                  class="img-fluid w-100"></a>

              <div class="content card-body" style="padding:10px 0px 30px 30px;">
                <h4 class="mt-4 " style="padding-bottom:8px;"><?php echo $name?></h4>
                <span class="mb-4"
                  style="padding:5px;background:#222;border-radius:10px;font-size:12px;padding:6px;color:white;margin-bottom:20px;">Pet
                  Adoption</span>
                <span class="mb-4"
                  style="padding:5px;background:#5cb85c;border-radius:10px;font-size:12px;padding:6px;color:white;margin-bottom:10px;">Pet
                  Vaccination</span>

                <p style="padding-top:20px;"> <i class="fa-solid fa-location-dot"></i> <?php echo $address?></p>
                <p><i class="fa-solid fa-paw"></i> Cats, Dogs, Rabbits </p>

              </div>
            </div>
          </div>
          <?php
              }
            }
          ?>
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