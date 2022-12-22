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

  <title>Vets</title>

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
          <h2>Our Vets</h2>
        </div>
        <div class="row">
          <?php
            $sql = "SELECT * FROM vets WHERE `status` ='1'";
            $result = mysqli_query($conn, $sql);
            if($result){
              while($row=mysqli_fetch_assoc($result)){
                                  
                $name=$row['firstname'] ." ". $row['lastname'];
                $edu=$row['education1'] ." / ". $row['education2'];
                $image=$row['image'];
                $vet_id=$row['vet_id'];

                $sql1 = "SELECT * FROM vet_ratings WHERE vet_id = '$vet_id'";
                $result1 = mysqli_query($conn, $sql1);
                $count = $result1->num_rows;
                        
                $query2 = "SELECT AVG(rating) AS average FROM vet_ratings WHERE vet_id = '$vet_id'";
                $result2 = mysqli_query($conn, $query2);
                $row2 = mysqli_fetch_assoc($result2);
                $avg = $row2['average'];
          ?>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="team-block mb-5 mb-lg-0">
              <img src="assets/img/doctors/<?php echo $image?>" alt="" class="img-fluid w-100">

              <div class="content">
                <h4 class="mt-4 mb-0"><a href="user_vet_profile.php?id=<?php echo $vet_id?>"><?php echo $name?></a></h4>
                <p><?php echo $edu?></p>
                <div class="d-flex justify-content-between">
                  
                  <h6 class="m-0"><i class="fa fa-star" style="color:gold;"></i>
                    <?php echo strlen(substr(strrchr($avg, "."), 2))?>
                    <small>(<?php echo $count?>) Ratings</small>
                  </h6>
                </div>
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