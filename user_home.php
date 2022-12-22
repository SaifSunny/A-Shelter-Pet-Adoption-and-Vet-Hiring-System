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

$img=$row['user_img'];
$user_id=$row['user_id'];

$_SESSION['image'] = $img;
$_SESSION['user_id'] = $row['user_id'];
$_SESSION['username'] = $row['username'];
$zip = $row['zip'];
$uid = $row['user_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>User Home</title>

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
        <div class="row">
          <div class="col-md-12">
            <div class="card mx-auto"
              style="text-align:center;padding-top:30px;padding-bottom:50px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); ">
              <h4 style="padding:30px;">My Meetings</h4>
              <div class="card-body text-center" style="padding:0 60px;">
                <table class="table" style="font-size: 14px;">
                  <thead>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Shelter Name</th>
                    <th>Meeting Time</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Action</th>
                  </thead>

                  <tbody>
                    <?php 
                      $sql = "SELECT * FROM adoption_requests WHERE `user_id`=$user_id";
                      $result = mysqli_query($conn, $sql);
                      if($result){
                        while($row=mysqli_fetch_assoc($result)){

                          $pet_img=$row['pet_image'];
                          $pet_name=$row['pet_name'];
                          $shelter_name=$row['shelter_name'];
                          $shelter_id=$row['shelter_id'];
                          $date=$row['date'];
                          $time=$row['time'];
                          $request_id=$row['request_id'];

                          $sql = "SELECT * FROM `shelter` WHERE shelter_id='$shelter_id'";
                          $result = mysqli_query($conn, $sql);
                          $row=mysqli_fetch_assoc($result);

                          $address=$row['address'] ." ".$row['city']."-". $row['zip'];
                          $contact=$row['contact'];
                    ?>
                    <tr>
                    <td><img src="./assets/img/pets/<?php echo $pet_img ?>" style="width:80px;border-radius: 20%;"
                          alt="profile"> <span style="padding-left:20px;"></span></td>
                      <td><?php echo $pet_name ?></td>
                      <td><?php echo $shelter_name ?></td>
                      <td><?php $part = explode('-', $date); echo $part[2]."-".$part[1]."-".$part[0]." ".$time ?></td>
                      <td><?php echo $contact ?></td>
                      <td><?php echo $address ?></td>
                      <td><a href="user_delete_meeting.php?id=<?php echo $request_id ?>" style="border-radius:50%"><img
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