<?php
include_once("./database/config.php");

session_start();
$username = $_SESSION['username'];

if (!isset($_SESSION['username'])) {
    header("Location: user_login.php");
}

$sql = "SELECT * FROM `users` WHERE username='$username'";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);

$img=$row['user_img'];
$user_id=$row['user_id'];
$user_name=$row['firstname']." ".$row['lastname'];

$appointment_id=$_GET['id'];

$sql = "SELECT * FROM vet_appointment WHERE appointment_id='$appointment_id'";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);

$vet_id = $row['vet_id'];
$vet_img = $row['vet_image'];
$vet_name= $row['vet_name'];

if(isset($_POST['submit'])){

  $rating = $_POST['rating'];
  $comment = $_POST['comment'];

  $query = "SELECT * FROM vet_ratings WHERE appointment_id = '$appointment_id'";
  $query_run = mysqli_query($conn, $query);
  if(!$query_run->num_rows > 0){
      $query2 = "INSERT INTO vet_ratings(appointment_id,`user_id`, vet_id, user_img, vet_img, `user_name`, vet_name, `rating`, `comment`)
      VALUES ('$appointment_id','$user_id', '$vet_id', '$img', '$vet_img', '$user_name', '$vet_name','$rating','$comment')";
      $query_run2 = mysqli_query($conn, $query2);
              
      if ($query_run2) {
          echo "<script> 
          alert('Rating Successfull');
          window.location.href='user_appointments.php';
          </script>";
      } 
      else {
        $cls="danger";
        $error = mysqli_error($conn);
      }
         

  }else{
      $query2 = "UPDATE vet_ratings SET rating = '$rating', comment='$comment' WHERE appointment_id='$appointment_id'";
      $query_run2 = mysqli_query($conn, $query2);
              
      if ($query_run2) {
        $cls="success";
        $error = "Rating Successfully Updated.";
      } 
      else {
        $cls="danger";
        $error = mysqli_error($conn);
      }
  }

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Rate the Vet</title>

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


    <section class="home-section" style="padding-bottom: 70px;">
      <!--  Teacher Table -->
      <div class="container">
      <div class="row ">
                    <div class="col-12 col-lg-12">
                        <form action="" method="POST" enctype='multipart/form-data'>
                            <div class="row " style="padding-top:30px;">
                                <div class="col-md-12">
                                    <div class="card mx-auto bg-light" style="padding:50px 0px; padding-left:40px;">
                                        <h5 class="card-title" style="padding-left:50px;font-weight:600">Rate the veterinarian</h5>
                                        <hr>
                                        <div class="card-body" style="padding:0 60px;">
                                            <form action="" method="POST">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="alert alert-<?php echo $cls;?>">
                                                            <?php 
                                                                if (isset($_POST['submit']) || isset($_POST['submit_img'])){
                                                                    echo $error;
                                                            }?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <label for="rating" style="padding-bottom:20px;">Rate the veterinarian</label>

                                                <div class="row">
                                                    <div class="rating" style="font-size:20px;">
                                                        <input type="radio" id="radio" name="rating" value="5" /><label
                                                            for="star5" title="Meh" style="padding: 0 20px;">5
                                                            stars</label>
                                                        <input type="radio" id="radio" name="rating" value="4" /><label
                                                            for="star4" title="Kinda bad" style="padding: 0 20px;">4
                                                            stars</label>
                                                        <input type="radio" id="radio" name="rating" value="3" /><label
                                                            for="star3" title="Kinda bad" style="padding: 0 20px;">3
                                                            stars</label>
                                                        <input type="radio" id="radio" name="rating" value="2" /><label
                                                            for="star2" title="Sucks big tim" style="padding: 0 20px;">2
                                                            stars</label>
                                                        <input type="radio" id="radio" name="rating" value="1" /><label
                                                            for="star1" title="Sucks big time"
                                                            style="padding: 0 20px;">1
                                                            star</label>
                                                    </div>
                                                </div>

                                                <div class="form-group mt-3">
                                                    <label for="contact"
                                                        style="padding-bottom:20px;">Comment</label><br>
                                                    <textarea name="comment" rows="5" cols="125"
                                                        placeholder="comment"></textarea>
                                                </div>

                                                <div class="text-end"><button class=" btn btn-primary"
                                                        style="margin-top:20px;margin-right:60px;" type="submit"
                                                        name="submit">Rate the veterinarian</button></div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                    </div>

                    </form>
                    <!--//app-card-->
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