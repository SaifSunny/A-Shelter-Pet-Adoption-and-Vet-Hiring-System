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

$image = $row['admin_img'];
$firstname=$row['firstname'];
$lastname=$row['lastname'];
$gender=$row['gender'];
$birthday=$row['birthday'];
$blood_group=$row['blood_group'];
$contact=$row['contact'];
$address=$row['address'];
$city=$row['city'];
$zip=$row['zip'];

if (isset($_POST['submit_img'])) {

    $error = "";
    $cls="";
 
    $name = $_FILES['file']['name'];
    $target_dir = "assets/img/admin/";
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
            $image_base64 = base64_encode(file_get_contents('assets/img/users/'.$name));
            $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;

            // Update Record
            $query2 = "UPDATE `admin` SET `admin_img`='$name' WHERE username='$username'";
            $query_run2 = mysqli_query($conn, $query2);

            $query3 = "UPDATE `recent` SET `image`='$name' WHERE `name`='$username'";
            $query_run3 = mysqli_query($conn, $query3);

            if ($query_run2 && $query_run3) {
                echo "<script> alert('Profile Image Successfully Updated.');
                window.location.href='admin_home.php';</script>";
            } 
            else {
                $cls="danger";
                $error = "Cannot Update Profile Image";
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

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender=$_POST['gender'];
    $birthday=$_POST['birthday'];
    $blood_group=$_POST['blood_group'];
    $contact=$_POST['contact'];
    $address=$_POST['address'];
    $city=$_POST['city'];
    $zip=$_POST['zip'];

    $error = "";
    $cls="";

        // Update Record
        $query2 = "UPDATE `admin` SET firstname='$firstname',lastname='$lastname',
        birthday='$birthday', blood_group='$blood_group', gender='$gender', contact='$contact',
        `address`='$address', city='$city', zip='$zip' WHERE username='$username'";
        $query_run2 = mysqli_query($conn, $query2);
        
        if ($query_run2) {
            $cls="success";
            $error = "Profile Successfully Updated.";
        } 
        else {
            $cls="danger";
            $error = "Cannot Update Profile";
        }

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Admin Profile</title>

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

    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>My Profile</h2>
          <ol>
            <li><a href="admin_home.php">Home</a></li>
            <li>My Profile</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs Section -->

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
                        <img src="./assets/img/admin/<?php echo $image;?>" width="100%" height="100%"
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

                  <div class="row" style="padding-top:30px">
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
                        <label style="padding-bottom:10px;">Date of Birth</label>
                        <input type="date" class="form-control" name="birthday" id="birthday"
                          value="<?php echo $birthday?>" placeholder="Birthday" required>
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
                    <div class="col-md-6">
                      <div class="form-group" style="padding:10px">
                        <label style="padding-bottom:10px;">Gender</label>
                        <input type="text" class="form-control" name="gender" id="gender" value="<?php echo $gender?>"
                          placeholder="Gender" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group" style="padding:10px">
                        <label style="padding-bottom:10px;">Blood Group</label>
                        <input type="text" class="form-control" name="blood_group" id="blood_group"
                          value="<?php echo $blood_group?>" placeholder="Blood Group" required>

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