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

$image = $row['image'];
$firstname=$row['firstname'];
$lastname=$row['lastname'];
$gender=$row['gender'];
$contact=$row['contact'];
$education1=$row['education1'];
$education2=$row['education2'];
$year1=$row['year1'];
$year2=$row['year2'];
$address=$row['clinic_address'];
$city=$row['clinic_city'];
$zip=$row['clinic_zip'];

if (isset($_POST['submit_img'])) {

    $error = "";
    $cls="";
 
    $name = $_FILES['file']['name'];
    $target_dir = "assets/img/doctors/";
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
            $image_base64 = base64_encode(file_get_contents('assets/img/doctors/'.$name));
            $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;

            // Update Record
            $query2 = "UPDATE vets SET `image`='$name' WHERE username='$username'";
            $query_run2 = mysqli_query($conn, $query2);

            $query3 = "UPDATE `recent` SET `image`='$name' WHERE `name`='$username'";
            $query_run3 = mysqli_query($conn, $query3);

            if ($query_run2 && $query_run3) {
                echo "<script> alert('Profile Image Successfully Updated.');
                window.location.href='vet_home.php';</script>";
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

if (isset($_POST['submit'])) {

    $image = $_POST['image'];
    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $gender=$_POST['gender'];
    $contact=$_POST['contact'];
    $education1=$_POST['education1'];
    $education2=$_POST['education2'];
    $year1=$_POST['year1'];
    $year2=$_POST['year2'];
    $address=$_POST['clinic_address'];
    $city=$_POST['clinic_city'];
    $zip=$_POST['clinic_zip'];

    $error = "";
    $cls="";

        // Update Record
        $query2 = "UPDATE vets SET firstname='$firstname',lastname='$lastname',
        education1='$education1', education2='$education2',contact='$contact',gender='$gender',
        year1='$year1', year2='$year2',`clinic_address`='$address', clinic_city='$city', clinic_zip='$zip' WHERE username='$username'";
        $query_run2 = mysqli_query($conn, $query2);
        
        if ($query_run2) {
            $cls="success";
            $error = "Profile Successfully Updated.";
        } 
        else {
            $cls="danger";
            $error = mysqli_error($conn);
        }

}


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
          <div class="col-md-4">
            <form action="" method="POST" enctype='multipart/form-data'>
              <div class="card mx-auto"
                style="text-align:center;padding-top:50px;padding-bottom:50px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); ">
                <h4 class="card-title" style="padding-bottom:20px;">My Profile</h4>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="col-md-12" style="width: 200px; height: 200px;">
                        <img src="./assets/img/doctors/<?php echo $image;?>" width="100%" height="100%"
                          style="text-align:center; margin-left:90px;">
                      </div>
                      <div class="col-md-12" style="padding-top:20px;">
                        <label for="file" class="form-label">Profile Image</label>
                        <div class="d-flex justify-content-center" style="padding-top:10px; padding-left:85px;">
                          <input type="file" name="file" id="file">
                        </div>
                        <div class="d-flex justify-content-center" style="padding-top:10px;">
                          <button type="submit_img" name="submit_img" class="btn btn-success"
                            style="margin-top:10px;"><i class="fa fa-edit"></i> Update
                            Image</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="col-md-8">
            <form action="" method="POST" enctype='multipart/form-data'>
              <div class="card mx-auto"
                style="text-align:center;padding:50px 0px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); ">
                <h4 class="card-title">Personal Information</h4>
                <div class="card-body" style="padding:0 60px;">
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

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group" style="padding:10px">
                        <label style="padding-bottom:10px;">First Name</label>
                        <input type="text" class="form-control" name="firstname" id="firstname"
                          value="<?php echo $firstname?>" placeholder="First Name" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group" style="padding:10px">
                        <label style="padding-bottom:10px;">Last Name</label>
                        <input type="text" class="form-control" name="lastname" id="lastname"
                          value="<?php echo $lastname?>" placeholder="Last Name" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group" style="padding:10px">
                        <label style="padding-bottom:10px;">Graduation</label>
                        <input type="text" class="form-control" name="education1" id="education1"
                          value="<?php echo $education1?>" placeholder="Graduation" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group" style="padding:10px">
                        <label style="padding-bottom:10px;">Year</label>
                        <input type="text" class="form-control" name="year1" id="year1" value="<?php echo $year1?>"
                          placeholder="Year" required>

                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group" style="padding:10px">
                        <label style="padding-bottom:10px;">Post Graduation</label>
                        <input type="text" class="form-control" name="education2" id="education2"
                          value="<?php echo $education2?>" placeholder="Post Graduation" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group" style="padding:10px">
                        <label style="padding-bottom:10px;">Year</label>
                        <input type="text" class="form-control" name="year2" id="year2" value="<?php echo $year2?>"
                          placeholder="Year" required>

                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group" style="padding:10px">
                        <label style="padding-bottom:10px;">Gender</label>
                        <input type="text" class="form-control" name="gender" id="gender" value="<?php echo $gender?>"
                          placeholder="Gender" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group" style="padding:10px">
                        <label style="padding-bottom:10px;">Contact</label>
                        <input type="text" class="form-control" name="contact" id="contact"
                          value="<?php echo $contact?>" placeholder="Contact" required>

                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group" style="padding:10px">
                        <label style="padding-bottom:10px;">Address</label>
                        <input type="text" class="form-control" name="address" id="address"
                          value="<?php echo $address?>" placeholder="Address" required>

                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group" style="padding:10px">
                        <label style="padding-bottom:10px;">City</label>
                        <input type="text" class="form-control" name="city" id="city" value="<?php echo $city?>"
                          placeholder="City" required>

                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group" style="padding:10px">
                        <label style="padding-bottom:10px;">Zip</label>
                        <input type="text" class="form-control" name="zip" id="zip" value="<?php echo $zip?>"
                          placeholder="Zip" required>

                      </div>
                    </div>
                  </div>
                  <div class="d-flex justify-content-end" style="padding-top:10px;">
                    <button type="submit" name="submit" class="btn btn-success" style="margin-right:10px;"><i
                        class="fa fa-edit"></i> Update</button>
                  </div>


                </div>
              </div>
          </div>
          </form>

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