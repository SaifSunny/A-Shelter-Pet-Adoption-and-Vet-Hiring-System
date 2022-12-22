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

$_SESSION['image'] = $img;
$_SESSION['admin_id'] = $row['admin_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Admin Home</title>

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

    <section class="inner-page">
      <div class="container">
        <div class="row" style="padding-top:30px;">
          <div class="col-md-3">
            <div class="card mx-auto"
              style="text-align:center;padding:30px 0px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); ">
              <h5 class="card-title" style="">Users</h5>
              <div class="card-body" style="text-align:center; font-size:18px;">
                <?php
                                    $sql = "SELECT * from users";
                                    $result = mysqli_query($conn, $sql);
                                    $row_cnt = $result->num_rows;
                                ?>
                <h1><?php echo $row_cnt?></h1>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="card mx-auto"
              style="text-align:center;padding:30px 0px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); ">
              <h5 class="card-title" style="">Vets</h5>
              <div class="card-body" style="text-align:center; font-size:18px;">
                <?php
                                    $sql = "SELECT * from vets";
                                    $result = mysqli_query($conn, $sql);
                                    $row_cnt = $result->num_rows;
                                ?>
                <h1><?php echo $row_cnt?></h1>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="card mx-auto"
              style="text-align:center;padding:30px 0px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); ">
              <h5 class="card-title" style="">Shelters</h5>
              <div class="card-body" style="text-align:center; font-size:18px;">
                <?php
                                    $sql = "SELECT * from shelter";
                                    $result = mysqli_query($conn, $sql);
                                    $row_cnt = $result->num_rows;
                                ?>
                <h1><?php echo $row_cnt?></h1>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card mx-auto"
              style="text-align:center;padding:30px 0px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); ">
              <h5 class="card-title" style="">Adopted</h5>
              <div class="card-body" style="text-align:center; font-size:18px;">
                <?php
                                    $sql = "SELECT * from adoption_requests WHERE `status`='1'";
                                    $result = mysqli_query($conn, $sql);
                                    $row_cnt = $result->num_rows;
                                ?>
                <h1><?php echo $row_cnt?></h1>
              </div>
            </div>
          </div>
        </div>
        <div class="row" style="padding-top:30px;">
          <div class="col-md-8">
            <div class="card mx-auto"
              style="text-align:center;padding:30px 0px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); ">
              <h5 class="card-title" style="padding-bottom:20px;">Vets</h5>
              <div class="card-body" style="padding:20px 40px; text-align:left;font-size:18px;">
                <table class="table">
                  <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Licence No.</th>
                    <th>Education</th>
                    <th>Status</th>
                  </thead>
                  <tbody>
                    <?php 
                      $sql = "SELECT * FROM vets ORDER BY vet_id DESC LIMIT 10;";
                      $result = mysqli_query($conn, $sql);
                      if($result){
                        while($row=mysqli_fetch_assoc($result)){
                                            
                          $name=$row['firstname']."  ".$row['lastname'];
                          $education=$row['education1'].", ".$row['education2'];
                          $reg_id=$row['reg_id'];
                          $vet_id=$row['vet_id'];
                          $status=$row['status'];

                          
                          if($status == 1){
                            $type = "success";
                            $msg = "Verified";
                          }else{
                              $type = "danger";
                              $msg = "Unverified";
                          }
                      ?>

                    <tr>
                      <td style="font-size:14px; font-weight:600;"><?php echo $vet_id ?></td>
                      <td style="font-size:14px; font-weight:600;"><?php echo $name ?></td>
                      <td style="font-size:14px; font-weight:600;"><?php echo $reg_id ?></td>
                      <td style="font-size:14px; font-weight:600;"><?php echo $education ?></td>
                      <td style="font-size:14px; font-weight:600;"><button
                          style="border-radius: 40px; padding:5px 14px; font-size:10px; font-weight:600"
                          class="btn btn-<?php echo $type?>"><?php echo $msg?></button></td>
                    </tr>
                    <?php 
                        }
                      }
                    ?>
                  </tbody>
                </table>

              </div>
              <div style="text-align:center">
                <a href="admin_verify_vet.php" style="font-weight:700; margin-top:50px">See All</a>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card mx-auto"
              style="text-align:center;padding:30px 0px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); ">
              <h5 class="card-title" style="padding-bottom:20px;">Recent Users</h5>
              <div class="card-body" style="padding:20px 40px; text-align:left;font-size:18px;">
                <table class="table">
                  <tbody>
                    <?php 
                        $sql = "SELECT DISTINCT `name`, `role`, `image` FROM recent ORDER BY id DESC LIMIT 8;";
                        $result = mysqli_query($conn, $sql);
                        if($result){
                          while($row=mysqli_fetch_assoc($result)){
                                            
                            $name=$row['name'];
                            $image=$row['image'];
                            $role=$row['role'];

                            if($role=="Admin"){
                              $path= "assets/img/admin";
                            }
                            elseif ($role=="Shelter"){
                              $path= "assets/img/shelters";
                            }
                              
                            elseif ($role=="Vet"){
                              $path= "assets/img/doctors";
                            }
                            else{
                              $path= "assets/img/users";
                            }
                            echo '<tr>
                              <td style="font-size:14px; font-weight:600; "> <img src="./'.$path.'/'.$image.'" style="width:40px;border-radius: 50%;" alt="profile"> <span style="padding-left:20px;">'.$name.'</span></td>
                              <td style="font-size:14px; font-weight:600; color:#bbb; padding-top:20px;">'.$role.'</td>
                            </tr>';
                          }
                        }
                      ?>
                  </tbody>
                </table>
                <div style="text-align:center">
                  <a href="#" style="font-weight:700; margin-top:50px">See All</a>
                </div>
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