<?php
include_once("./database/config.php");

session_start();

$username = $_SESSION['sheltername'];

if (!isset($_SESSION['sheltername'])) {
    header("Location: shelter_login.php");
}

$sql = "SELECT * FROM `shelter` WHERE username='$username'";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);

$img=$row['shelter_img'];
$shelter_id=$row['shelter_id'];
$_SESSION['shelter_id'] = $row['shelter_id'];

  if(isset($_POST['submit'])){

    $pet_name = $_POST['name'];
    $age = $_POST['age'];
    $pet_type = $_POST['pet_type'];
    $trained = $_POST['trained'];
    $vaccinated = $_POST['vaccinated'];
    $background = $_POST['background'];

    $post_date = date("Y-m-d");

    $error = "";
    $cls="";
 
    $name = $_FILES['file']['name'];
    $target_dir = "assets/img/pets/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
  
    // Select file type
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  
    // Valid file extensions
    $extensions_arr = array("jpg","jpeg","png","gif");

    // Check extension
    if( in_array($imageFileType,$extensions_arr) ){

      // Upload file
      if(move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name)){

          // Convert to base64 
          $image_base64 = base64_encode(file_get_contents('assets/img/pets/'.$name));
          $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;

          // Insert record

          $query2 = "INSERT INTO adoption(pet_img, pet_name,age,pet_type,trained,vaccinated,post_date,shelter_id, background)
          VALUES ('$name','$pet_name','$age','$pet_type','$trained','$vaccinated','$post_date','$shelter_id','$background')";
          $query_run2 = mysqli_query($conn, $query2);

          if ($query_run2) {
              $cls="success";
              $error = "Pet Successfully Added.";
          } 
          else {
              $cls="danger";
              $error = mysqli_error($conn);
          }

      }else{
          $cls="danger";
          $error = 'Unknown Error Occurred.';
      }
    }else{
      $cls="danger";
      $error = 'Invalid File Type';
    }
   
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Manage Pets</title>

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



  <main id="main">
    <!-- Navbar Start -->
    <?php include_once("./templates/shelter_header.php");?>
    <!-- Navbar end -->
    <!-- ======= Breadcrumbs Section ======= -->
    <section>
    </section><!-- End Breadcrumbs Section -->


    <section class="inner-page">
      <div class="container">
        <form action="" method="POST" enctype='multipart/form-data'>
          <div class="row" style="padding-top:30px;">
            <div class="col-md-4">
              <div class="card mx-auto"
                style="text-align:center;padding-top:50px;padding-bottom:50px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); ">
                <h4 class="card-title" style="padding-bottom:20px;">Profile Image</h4>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="col-md-12" style="width: 200px; height: 200px;">
                        <img src="./assets/img/pets/default.png" width="100%" height="100%"
                          style="text-align:center; margin-left:90px;">
                      </div>
                      <div class="col-md-12" style="padding-top:20px;">
                        <label for="file" class="form-label">Profile Image</label>
                        <div class="d-flex justify-content-center" style="padding-top:10px; padding-left:85px;">
                          <input type="file" name="file" id="file">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mx-auto"
                style="text-align:center;padding:50px 0px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); ">
                <h4 class="card-title">Add Pet</h4>
                <div class="card-body" style="padding:0 60px;">

                  <div class="alert alert-<?php echo $cls;?>">
                    <?php 
                      if (isset($_POST['submit'])){
                        echo $error;
                      }?>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group" style="padding:10px">
                        <label style="padding-bottom:10px;">Pet Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Pet Name">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group" style="padding:10px">
                        <label style="padding-bottom:10px;">Age</label>
                        <input type="text" class="form-control" name="age" id="age" placeholder="Age">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group" style="padding:10px">
                        <label style="padding-bottom:10px;">Pet Type</label>
                        <select class="form-control" name="pet_type" id="pet_type" placeholder="Pet Type" required>
                          <option>-- Select Type --</option>
                          <option value="cat">Cat</option>
                          <option value="dog">Dog</option>
                          <option value="rabbit">Rabbit</option>
                          <option value="bird">Bird</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group" style="padding:10px">
                        <label style="padding-bottom:10px;">Trained</label>
                        <select class="form-control" name="trained" id="trained" placeholder="Trained" required>
                          <option value="yes">Yes</option>
                          <option value="no">No</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group" style="padding:10px">
                        <label style="padding-bottom:10px;">Vaccinated</label>
                        <select class="form-control" name="vaccinated" id="vaccinated" placeholder="Vaccinated"
                          required>
                          <option value="yes">Yes</option>
                          <option value="no">No</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group" style="padding:10px">
                        <label style="padding-bottom:10px;">Background</label> <br>
                        <textarea class="form-control" id="background" name="background" rows="4"
                          placeholder="Write somethng about the pet..."></textarea>
                      </div>
                    </div>
                    <div class="d-flex justify-content-end" style="padding-top:20px;">
                      <button type="submit" name="submit" class="btn btn-success" style="margin-right:10px;"><i
                          class="fas fa-plus-square"></i>&nbsp;&nbsp;Add
                        Pet</button>
                      <a href="shelter_pets.php" class="btn btn-primary">Go Back</a>
                    </div>


                  </div>
                </div>
              </div>


            </div>

        </form>

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