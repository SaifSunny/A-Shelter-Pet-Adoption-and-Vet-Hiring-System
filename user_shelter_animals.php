<?php
include_once("./database/config.php");

session_start();
$username = $_SESSION['username'];

if (!isset($_SESSION['username'])) {
    header("Location: user_login.php");
}

$id = $_GET['id'];

$sql = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Shelter Animals</title>

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
          <h2>Adpotion Animals</h2>
        </div>
        <div class="row">
        <?php
            $sql = "SELECT * FROM adoption WHERE `shelter_id` = '$id' and adopted =0";
            $result = mysqli_query($conn, $sql);
            if($result){
              while($row=mysqli_fetch_assoc($result)){
                                  
                $name=$row['pet_name'];
                $image=$row['pet_img'];
                $age=$row['age'];
                $trained=$row['trained'];
                $background=$row['background'];
                $pet_type=$row['pet_type'];
                $vaccinated=$row['vaccinated'];
                $pet_id=$row['pet_id'];
          ?>
          <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="team-block mb-5 mb-lg-0 card" style=" box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2)">
              <img src="assets/img/pets/<?php echo $image?>" alt="" class="img-fluid w-100">

              <div class="content card-body">
                <h4 class="mt-4 mb-0" style="font-weight:700;padding-bottom:10px;"><a href="" style="font-weight:700;margin-bottom:20px;"><?php echo $name?></a></h4>
                <p style="font-weight:600"><?php echo "Pet: ".$pet_type .", Age: ". $age.", <br> Vaccinated: ". $vaccinated.", Trained: ".$trained?></p>
                <p><?php echo $background?></p>
                <a href="user_book_meeting.php?id=<?php echo $pet_id?>" class="appointment-btn scrollto"
                style="margin:0; padding: 15px 50px; margin:20px 0;">Book Meeting</a>
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