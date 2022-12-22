<?php
include_once("./database/config.php");

session_start();

$username = $_SESSION['vetname'];

if (!isset($_SESSION['vetname'])) {
    header("Location: vet_login.php");
}

$sql = "SELECT * FROM vets WHERE username='$username'";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);

$img=$row['image'];
$vet_id=$row['vet_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>My Appointments</title>

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
  <?php include_once("./templates/vet_header.php");?>
  <!-- Navbar end -->

  <main id="main">

    <section> </section>

    <section class="inner-page">
      <div class="container">
        <div class="row" style="padding-top:30px;">
          <div class="col-md-12">
            <div class="card mx-auto"
              style="text-align:center;padding:30px 0px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); ">
              <h5 class="card-title" style="padding-top:20px ;">My Appointments</h5>
              <div class="card-body" style="padding:20px 40px; text-align:left;font-size:18px;">
                <table class="table">
                  <tbody>
                    <thead>
                      <th>ID</th>
                      <th>Profile</th>
                      <th>Name</th>
                      <th>Patient's Name</th>
                      <th>Date</th>
                      <th>Time</th>
                      <th>Contact</th>
                      <th></th>
                    </thead>
                    <?php 
                      $sql = "SELECT * FROM vet_appointment WHERE vet_id = '$vet_id' AND `status` ='0'  ORDER BY `date` DESC";
                      $result = mysqli_query($conn, $sql);
                      if($result){
                        while($row=mysqli_fetch_assoc($result)){
                                            
                          $user_image =$row['user_image'];
                          $aid =$row['appointment_id'];
                          $user_id =$row['user_id'];
                          $user_name =$row['user_name'];
                          $pet_name =$row['pet_name'];
                          $date =$row['date'];
                          $time =$row['time'];
                          $contact =$row['contact'];
                    ?>
                    <tr>
                      <td style="font-size:14px; color:black; font-weight:600; "><?php echo $aid?></td>
                      <td style="font-size:14px; color:black; font-weight:600;"> <img
                          src="./assets/img/users/<?php echo $user_image?>" style="width:40px;border-radius: 50%;"
                          alt="profile">
                      </td>
                      <td style="font-size:14px; color:black; font-weight:600; "><?php echo $user_name?></td>
                      <td style="font-size:14px; color:black; font-weight:600; "><?php echo $pet_name?></td>
                      <td style="font-size:14px; color:black; font-weight:600; ">
                        <?php $part = explode('-', $date); echo $part[2]."-".$part[1]."-".$part[0]?></td>
                      <td style="font-size:14px; color:black; font-weight:600; "><?php echo $time?></td>
                      <td style="font-size:14px; color:black; font-weight:600; "><?php echo $contact?></td>
                      <td style="font-size:14px; font-weight:600;">
                        <a href="vet_complete_appointment.php?id=<?php echo $aid?>"
                          style="padding:1px; border-radius:50%"><img src="./assets/img/check.png" alt="" width="30"
                            height="30"></a>
                        <a href="vet_cancel_appointment.php?id=<?php echo $aid?>" style="padding:1px; border-radius:50%"><img
                            src="./assets/img/trash.png" alt="" width="30" height="30"></a>
                      </td>
                    </tr>
                    <?php
                        }
                      }
                    ?>
                  </tbody>
                </table>

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