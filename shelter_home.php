<?php
include_once("./database/config.php");

session_start();

$username = $_SESSION['sheltername'];

if (!isset($_SESSION['sheltername'])) {
    header("Location: shelter_login.php");
}

$sql = "SELECT * FROM shelter WHERE username='$username'";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);

$img=$row['shelter_img'];
$shelter_id=$row['shelter_id'];

$_SESSION['image'] = $img;
$_SESSION['shelter_id'] = $row['shelter_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Shelter Home</title>

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
  <?php include_once("./templates/shelter_header.php");?>
  <!-- Navbar end -->

  <main id="main">

    <section> </section>

    <section class="inner-page">
      <div class="container">
        <div class="row" style="padding-top:30px;">
          <div class="col-md-12">
            <div class="card mx-auto"
              style="text-align:center;padding:30px 0px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); ">
              <h4 class="card-title" style="padding-top:20px;">Adoption Posts</h4>
              <div class="butt" style="text-align:right; padding-right:70px; padding-bottom:40px;">
                <a href="shelter_add_pet.php" class="btn btn-success">Put for Adoption</a>
              </div>
              <div class="card-body" style="padding:20px 40px; text-align:left;font-size:18px;">
                <table class="table" style="text-align:center;">
                  <tbody>
                    <thead>
                      <th>Image</th>
                      <th>Pet Name</th>
                      <th>Type</th>
                      <th>Age</th>
                      <th>Trained</th>
                      <th>Vaccinated</th>
                      <th>Background</th>
                      <th>Post Date</th>
                      <th>Action</th>
                    </thead>
                    <?php 
                      $sql = "SELECT * FROM adoption WHERE shelter_id = '$shelter_id' where adopted=0 ORDER BY post_date DESC";
                      $result = mysqli_query($conn, $sql);

                      if($result){
                        while($row=mysqli_fetch_assoc($result)){
                                            
                          $pet_img =$row['pet_img'];
                          $id =$row['pet_id'];
                          $shelter_id =$row['shelter_id'];
                          $pet_name =$row['pet_name'];
                          $age =$row['age'];
                          $trained =$row['trained'];
                          $background =$row['background'];
                          $pet_type =$row['pet_type'];
                          $vaccinated =$row['vaccinated'];
                          $post_date =$row['post_date'];

                    ?>
                    <tr>
                      <td style="font-size:14px; color:black; font-weight:600;"> <img
                          src="./assets/img/pets/<?php echo $pet_img?>" style="width:40px;border-radius: 50%;"
                          alt="profile">
                      </td>
                      <td style="font-size:14px; color:black; font-weight:600; "><?php echo $pet_name?></td>
                      <td style="font-size:14px; color:black; font-weight:600; "><?php echo $pet_type?></td>
                      <td style="font-size:14px; color:black; font-weight:600; "><?php echo $age?></td>
                      <td style="font-size:14px; color:black; font-weight:600; "><?php echo $trained?></td>
                      <td style="font-size:14px; color:black; font-weight:600; "><?php echo $vaccinated?></td>
                      <td style="font-size:14px; color:black; font-weight:600; "><?php echo $background?></td>
                      <td style="font-size:14px; color:black; font-weight:600; ">
                        <?php $part = explode('-', $post_date); echo $part[2]."-".$part[1]."-".$part[0]?></td>
                      <td><a href="shelter_adopted.php?id=<?php echo $id ?>" style="border-radius:50%"><img
                            src="./assets/img/check.png" alt="" width="30" height="30"></a>
                        <a href="shelter_delete_pet.php?id=<?php echo $id ?>" style="border-radius:50%"><img
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