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
$_SESSION['admin_id'] = $row['admin_id'];

if(isset($_POST['submit'])){

    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $shelter_name = $_POST['shelter_name'];
    $shelter_reg_id = $_POST['shelter_reg_id'];
    $contact = $_POST['contact'];
    $username = $_POST['username'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $zip = $_POST['zip'];

    $date = date("Y-m-d");


    $p = $_POST['password'];
    $error = "";
    $cls="";
 
    $name = $_FILES['file']['name'];
    $target_dir = "assets/img/shelters/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
  
    // Select file type
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  
    // Valid file extensions
    $extensions_arr = array("jpg","jpeg","png","gif");

    if (strlen($p) > 5) {
    
        $query = "SELECT * FROM shelter WHERE shelter_reg_id = '$shelter_reg_id'";
        $query_run = mysqli_query($conn, $query);
        if (!$query_run->num_rows > 0) {

            $query = "SELECT * FROM shelter WHERE shelter_reg_id = '$shelter_reg_id' AND email = '$email'";
            $query_run = mysqli_query($conn, $query);
            if(!$query_run->num_rows > 0){

                // Check extension
                if( in_array($imageFileType,$extensions_arr) ){

                    // Upload file
                    if(move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name)){

                        // Convert to base64 
                        $image_base64 = base64_encode(file_get_contents('assets/img/shelters/'.$name));
                        $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;

                        // Insert record

                        $query2 = "INSERT INTO shelter(shelter_name,contact,address,city,zip,email,`password`, shelter_reg_id, join_date, `shelter_img`,username, verified)
                        VALUES ('$shelter_name','$contact','$address','$city','$zip', '$email', '$password', '$shelter_reg_id','$date', '$name', '$username', '1')";
                        $query_run2 = mysqli_query($conn, $query2);
            
                        if ($query_run2) {
                            $cls="success";
                            $error = "Shelter Successfully Added.";
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
            else{
                $cls="danger";
                $error = "Shelter Already Exists";
            }
            
        }else{
            $cls="danger";
            $error = "Username Already Exists";
        }
    }else{
        $cls="danger";
        $error = 'Password has to be minimum of 6 charecters.';
    }
   
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Add Shelters</title>

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
    <!-- Navigation Start -->
    <?php include_once("./templates/admin_header.php");?>
    <!-- Navigation end -->


  <main id="main">

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
                      <div class="col-md-12" style="width: 300px; height: 200px;">
                        <img src="./assets/img/shelters/default.png" width="100%" height="100%"
                          style="text-align:center; margin-left:45px;">
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
                <h4 class="card-title">Add Shelter</h4>
                <div class="card-body" style="padding:0 60px;">

                  <div class="alert alert-<?php echo $cls;?>">
                    <?php 
                      if (isset($_POST['submit'])){
                        echo $error;
                      }?>
                  </div>

                  <div class="row" style="padding-top:20px;">
                    <div class="col-md-12">
                      <div class="form-group" style="padding:10px">
                        <label style="padding-bottom:10px;">Shelter Name</label>
                        <input type="text" class="form-control" name="shelter_name" id="shelter_name"
                          placeholder="Shelter Name">
                      </div>
                    </div>
                  </div>


                  <div class="row" style="padding-top:10px;">
                    <div class="col-md-6">
                      <div class="form-group" style="padding:10px">
                        <label style="padding-bottom:10px;">Shelter Regitration No.</label>
                        <input type="text" class="form-control" name="shelter_reg_id" id="shelter_reg_id"
                          placeholder="Shelter Registration No.">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group" style="padding:10px">
                        <label style="padding-bottom:10px;">Contact</label>
                        <input type="text" class="form-control" name="contact" id="contact" placeholder="Contact">
                      </div>
                    </div>

                  </div>

                  <div class="row" style="padding-top:10px;">
                    <div class="col-md-12">
                      <div class="form-group" style="padding:10px">
                        <label style="padding-bottom:10px;">Address</label>
                        <input type="text" class="form-control" name="address" id="address" placeholder="Address">
                      </div>
                    </div>
                  </div>

                  <div class="row" style="padding-top:10px;">
                    <div class="col-md-6">
                      <div class="form-group" style="padding:10px">
                        <label style="padding-bottom:10px;">City</label>
                        <input type="text" class="form-control" name="city" id="city" placeholder="City">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group" style="padding:10px">
                        <label style="padding-bottom:10px;">Zip</label>
                        <input type="text" class="form-control" name="zip" id="zip" placeholder="Zip">
                      </div>
                    </div>
                  </div>
                  <div class="row" style="padding-top:10px;">
                    <div class="col-md-12">
                      <div class="form-group" style="padding:10px">
                        <label style="padding-bottom:10px;">Username</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                      </div>
                    </div>
                  </div>

                  <div class="row" style="padding-top:10px;">
                    <div class="col-md-6">
                      <div class="form-group" style="padding:10px">
                        <label style="padding-bottom:10px;">Email</label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="Email">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group" style="padding:10px">
                        <label style="padding-bottom:10px;">Password</label>
                        <input type="text" class="form-control" name="password" id="password" placeholder="Password">
                      </div>
                    </div>
                  </div>


                  <div class="d-flex justify-content-end" style="padding-top:20px;">
                    <button type="submit" name="submit" class="btn btn-success" style="margin-right:10px;"><i
                        class="fas fa-plus-square"></i>&nbsp;&nbsp;Add
                        Shelter</button>
                    <a href="admin_shelters.php" class="btn btn-primary">Go Back</a>
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