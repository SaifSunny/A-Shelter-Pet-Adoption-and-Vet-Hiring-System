<?php
include_once("./database/config.php");

session_start();
$username = $_SESSION['adminname'];

if (!isset($_SESSION['adminname'])) {
    header("Location: admin_login.php");
}

$sql = "SELECT * FROM `admin` WHERE username='$username'";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);

$img=$row['admin_img'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Manage Users</title>

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
  <?php include_once("./templates/admin_header.php");?>
  <!-- Navbar end -->

  <main id="main">

    <section> </section>


    <section class="home-section" style="padding-bottom: 70px;">
      <!--  Teacher Table -->
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="card mx-auto"
              style="text-align:center;padding-top:30px;padding-bottom:50px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); ">
              <h4 style="padding:30px;">Manage Users</h4>
              <div class="butt" style="text-align:right; padding-right:70px; padding-bottom:40px;">
                <a href="admin_add_user.php" class="btn btn-success">Add Users</a>
              </div>
              <div class="card-body text-center" style="padding:0 60px;">
                <table class="table" style="font-size: 14px;">
                  <thead>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Birthday</th>
                    <th>Contact</th>
                    <th>Blood Group</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Action</th>
                  </thead>

                  <tbody>
                    <?php 
                      $sql = "SELECT * FROM users";
                      $result = mysqli_query($conn, $sql);
                      if($result){
                        while($row=mysqli_fetch_assoc($result)){
                          $id=$row['user_id'];

                          $name=$row['firstname'] ." ". $row['lastname'];
                          $birthday=$row['birthday'];
                          $gender=$row['gender'];
                          $contact=$row['contact'];
                          $email=$row['email'];
                          $blood_group=$row['blood_group'];
                          $address=$row['address'].",".$row['city'].",".$row['zip'];
                          $image=$row['user_img'];
                    ?>
                    <tr>
                      <td><img src="./assets/img/users/<?php echo $image ?>" style="width:40px;border-radius: 20%;"
                          alt="profile"> <span style="padding-left:20px;"></span></td>
                      <td><?php echo $name ?></td>
                      <td><?php echo $gender ?></td>
                      <td><?php echo $birthday ?></td>
                      <td><?php echo $contact ?></td>
                      <td><?php echo $blood_group ?></td>
                      <td><?php echo $email ?></td>
                      <td><?php echo $address ?></td>
                      <td><a href="admin_delete_user.php?id=<?php echo $id?>" style="border-radius:50%"><img
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