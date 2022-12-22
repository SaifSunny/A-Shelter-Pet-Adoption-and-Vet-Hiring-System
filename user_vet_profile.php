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

$sql = "SELECT * FROM vets WHERE vet_id='$id'";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);

$name=$row['firstname'] ." ". $row['lastname'];
$image=$row['image'];
$education1=$row['education1'];
$education2=$row['education2'];
$year1=$row['year1'];
$year2=$row['year2'];
$gender=$row['gender'];
$contact=$row['contact'];
$email=$row['email'];
$address=$row['clinic_address'];
$city=$row['clinic_city'];
$zip=$row['clinic_zip'];

$sql1 = "SELECT * FROM vet_ratings WHERE vet_id = '$id'";
$result1 = mysqli_query($conn, $sql1);
$count = $result1->num_rows;
                        
$query2 = "SELECT AVG(rating) AS average FROM vet_ratings WHERE vet_id = '$id'";
$result2 = mysqli_query($conn, $query2);
$row2 = mysqli_fetch_assoc($result2);
$avg = $row2['average'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Vet Profile</title>

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
          <h2>Vet Profile</h2>
        </div>
        <div class="row">
          <div class="col-lg-4 col-md-6">
            <div class="doctor-img-block">
              <img src="assets/img/doctors/<?php echo $image?>" alt="" class="img-fluid w-100">

              <div class="info-block mt-4">
                <h4 class="mb-0"><?php echo $name?></h4>
                <p><?php echo $education1." / ".$education2?></p>
                <h6 class="m-0"><i class="fa fa-star" style="color:gold;"></i>
                    <?php echo strlen(substr(strrchr($avg, "."), 2))?>
                    <small>(<?php echo $count?>) Ratings</small>
                  </h6>

                <ul class="list-inline mt-4 doctor-social-links">
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

          <div class="col-lg-5">
            <div class="doctor-details mt-4 mt-lg-0">

              <h2 class="text-md" style="font-weight:700">Introducing to myself</h2>
              <div class="divider my-4"></div>
              <p>We are ensuring you the best services for your pet.</p>
              <p>Gender: <?php echo $gender?></p>
              <p>Clinic Address: <?php echo $address?> <br> <?php echo $city." ".$zip?> </p>

              <a href="user_vet_appoinment.php?id=<?php echo $id?>" class="appointment-btn scrollto"
                style="margin:0; padding: 15px 50px; margin-top:30px;">Make an Appoinment</a>
            </div>
          </div>

          <div class="col-lg-3">
            <div class="">
              <h5 class="mb-4" style="font-weight:700">Make Appoinment</h5>

              <ul class="list-unstyled lh-35">
                <li class="d-flex justify-content-between align-items-center">
                  <a href="#">Monday - Friday</a>
                  <span>9:00 - 17:00</span>
                </li>
                <li class="d-flex justify-content-between align-items-center">
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

            <div class="skill-list" style="padding-top:70px;">
              <h5 class="mb-4" style="font-weight:700">Expertise area</h5>
              <ul class="list-unstyled department-service">
                <li><i class='bx bx-check' style="color:blue; font-size:25px; padding-right:10px;"></i>Pet Checkup</li>
                <li><i class='bx bx-check' style="color:blue; font-size:25px; padding-right:10px;"></i>Pet Surgery</li>
                <li><i class='bx bx-check' style="color:blue; font-size:25px; padding-right:10px;"></i>Pet Grooming</li>
                <li><i class='bx bx-check' style="color:blue; font-size:25px; padding-right:10px;"></i>Medicines</li>
                <li><i class='bx bx-check' style="color:blue; font-size:25px; padding-right:10px;"></i>Adoption</li>
                <li><i class='bx bx-check' style="color:blue; font-size:25px; padding-right:10px;"></i>Vaccines</li>
              </ul>
            </div>

          </div>
        </div>
      </div>
    </section>

    <section class="section doctor-qualification gray-bg">
      <div class="container">
        <div class="section-title">
          <h2>My Educational Qualifications</h2>
        </div>

        <div class="row">
          <div class="col-lg-6">
            <div class="edu-block mb-5">
              <span class="h6 text-muted"><?php $part = explode('-', $year1); echo $part[0]?></span>
              <h4 class="mb-3 title-color"><?php echo $education1?></h4>
              <p>Completed my study from veterinary institute. I have experience in treating animals for over 4years. You can rely on me for the healthcare of your pets.</p>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="edu-block mb-5">
              <span class="h6 text-muted"><?php $part = explode('-', $year2); echo $part[0]?></span>
              <h4 class="mb-3 title-color"><?php echo $education2?></h4>
              <p> I am an expert to handle animals. </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="section doctor-qualification gray-bg">
      <div class="container">
        <div class="section-title">
          <h2>Ratings</h2>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <div class="chart-container">
              <table>
                <tbody>
                  <?php
                      $query = "SELECT * FROM vet_ratings WHERE vet_id = '$id'";
                      $result = mysqli_query($conn, $query);
                      if($result){
                        while($row=mysqli_fetch_assoc($result)){
                          $user_id=$row['user_id'];
                          $user_name=$row['user_name'];
                          $user_img=$row['user_img'];
                          $rating=$row['rating'];
                          $comment=$row['comment'];
                                                                                                
                                                                    
                  ?>
                  <tr>
                    <td>
                      <img class="profile-image" src="assets/img/users/<?php echo $user_img?>" alt="" width="70px;"
                        style="margin-right:10px;">
                    </td>
                    <td>
                      <h4 class="notification-title mb-1">
                        <?php echo $user_name?>
                      </h4>
                      <div class="ratings">
                        <p class="d-flex">
                          <?php
                            for($i=0; $i<5; $i++){
                                if($i<$rating){
                        ?>
                          <i class="fa fa-star" style="color:gold;"></i>
                          <?php
                                }else{
                        ?>
                          <i class="fa fa-star"></i> <br>
                          <?php
                                }
                            }
                        ?>


                        </p>


                      </div>
                      <p>
                        <?php echo $comment?>

                      </p>
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