<?php
include_once("./database/config.php");

session_start();
$username = $_SESSION['sheltername'];

if (!isset($_SESSION['sheltername'])) {
    header("Location: user_login.php");
}

$sql = "SELECT * FROM shelter WHERE username='$username'";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);

$image = $row['shelter_img'];
$shelter_name=$row['shelter_name'];
$shelter_reg_id=$row['shelter_reg_id'];
$contact=$row['contact'];
$email=$row['email'];
$address=$row['address'];
$city=$row['city'];
$zip=$row['zip'];

if (isset($_POST['submit_img'])) {

    $error = "";
    $cls="";
 
    $name = $_FILES['file']['name'];
    $target_dir = "assets/img/shelters/";
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
            $image_base64 = base64_encode(file_get_contents('assets/img/shelters/'.$name));
            $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;

            // Update Record
            $query2 = "UPDATE shelter SET `shelter_img`='$name' WHERE username='$username'";
            $query_run2 = mysqli_query($conn, $query2);

            $query3 = "UPDATE `recent` SET `image`='$name' WHERE `name`='$username'";
            $query_run3 = mysqli_query($conn, $query3);

            if ($query_run2 && $query_run3) {
                echo "<script> alert('Profile Image Successfully Updated.');
                window.location.href='shelter_home.php';</script>";
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

    $shelter_name = $_POST['shelter_name'];
    $shelter_reg_id=$_POST['shelter_reg_id'];
    $contact=$_POST['contact'];
    $address=$_POST['address'];
    $city=$_POST['city'];
    $zip=$_POST['zip'];

    $error = "";
    $cls="";

        // Update Record
        $query2 = "UPDATE shelter SET shelter_name='$shelter_name',shelter_reg_id='$shelter_reg_id', contact='$contact',
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

  <title>My Profile</title>

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
          <div class="col-md-4">
            <form action="" method="POST" enctype='multipart/form-data'>
              <div class="card mx-auto"
                style="text-align:center;padding-top:50px;padding-bottom:50px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); ">
                <h4 class="card-title" style="padding-bottom:20px;">My Profile</h4>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="col-md-12" style="width: 200px; height: 200px;">
                        <img src="./assets/img/shelters/<?php echo $image;?>" width="150%" height="100%"
                          style="text-align:center; margin-left:40px;">
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
                        <label style="padding-bottom:10px;">Shelter Name</label>
                        <input type="text" class="form-control" name="shelter_name" id="shelter_name"
                          value="<?php echo $shelter_name?>" placeholder="Shelter Name" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group" style="padding:10px">
                        <label style="padding-bottom:10px;">Registration Id</label>
                        <input type="text" class="form-control" name="shelter_reg_id" id="shelter_reg_id"
                          value="<?php echo $shelter_reg_id?>" placeholder="Registration ID" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                  <div class="col-md-6">
                      <div class="form-group" style="padding:10px">
                        <label style="padding-bottom:10px;">Email</label>
                        <input type="email" class="form-control" name="email" id="email"
                          value="<?php echo $email?>" placeholder="Email" required>

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