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

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $reg_id = $_POST['reg_id'];
    $birthday = $_POST['birthday'];
    $username = $_POST['username'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $zip = $_POST['zip'];
    $education1 = $_POST['education1'];
    $education2 = $_POST['education2'];
    $year1 = $_POST['year1'];
    $year2 = $_POST['year2'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $zip = $_POST['zip'];

    $date = date("Y-m-d");

    $p = $_POST['password'];
    $error = "";
    $cls="";
 
    $name = $_FILES['file']['name'];
    $target_dir = "assets/img/doctors/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
  
    // Select file type
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  
    // Valid file extensions
    $extensions_arr = array("jpg","jpeg","png","gif");

    if (strlen($p) > 5) {
    
        $query = "SELECT * FROM vets WHERE username = '$username'";
        $query_run = mysqli_query($conn, $query);
        if (!$query_run->num_rows > 0) {

            $query = "SELECT * FROM vets WHERE reg_id = '$reg_id' AND email = '$email'";
            $query_run = mysqli_query($conn, $query);
            if(!$query_run->num_rows > 0){

                // Check extension
                if( in_array($imageFileType,$extensions_arr) ){

                    // Upload file
                    if(move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name)){

                        // Convert to base64 
                        $image_base64 = base64_encode(file_get_contents('assets/img/doctors/'.$name));
                        $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;

                        // Insert record

                        $query2 = "INSERT INTO vets(firstname,lastname,reg_id,education1,education2,year1,year2,gender,contact,clinic_address,clinic_city,clinic_zip,  username,email,`password`, join_date, `image`,  `status`)
                        VALUES ('$firstname','$lastname','$reg_id','$education1','$education2','$year1','$year2','$gender','$contact','$address','$city','$zip','$username', '$email', '$password', '$date', '$name', '1')";
                        $query_run2 = mysqli_query($conn, $query2);
            
                        if ($query_run2) {
                            $cls="success";
                            $error = "Vet Successfully Added.";
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
                $error = "Vet Already Exists";
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

  <title>Add Vets</title>

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
  <?php include_once("./templates/admin_header.php");?>
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
                        <img src="./assets/img/doctors/default.png" width="100%" height="100%"
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
                <h4 class="card-title">Add Vet</h4>
                <div class="card-body" style="padding:0 60px;">

                  <div class="alert alert-<?php echo $cls;?>">
                    <?php 
                      if (isset($_POST['submit'])){
                        echo $error;
                      }?>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group" style="padding:10px">
                        <label style="padding-bottom:10px;">First Name</label>
                        <input type="text" class="form-control" name="firstname" id="firstname"
                          placeholder="First Name">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group" style="padding:10px">
                        <label style="padding-bottom:10px;">Last Name</label>
                        <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group" style="padding:10px">
                        <label style="padding-bottom:10px;">Licence NO.</label>
                        <input type="text" class="form-control" name="reg_id" id="reg_id" placeholder="Licence No.">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group" style="padding:10px">
                        <label style="padding-bottom:10px;">Graduation</label>
                        <input type="text" class="form-control" name="education1" id="education1"
                          placeholder="Graduation">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group" style="padding:10px">
                        <label style="padding-bottom:10px;">Year</label>
                        <input type="month" class="form-control" name="year1" id="year1"
                          placeholder="Graduation Year">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group" style="padding:10px">
                        <label style="padding-bottom:10px;">Post Graduation</label>
                        <input type="text" class="form-control" name="education2" id="education2"
                          placeholder="Post Graduation">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group" style="padding:10px">
                        <label style="padding-bottom:10px;">Year</label>
                        <input type="month" class="form-control" name="year2" id="year2"
                          placeholder="Post Graduation Year">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group" style="padding:10px">
                        <label style="padding-bottom:10px;">Gender</label>
                        <select class="form-control" name="gender" id="gender" placeholder="Gender" required>
                          <option>-- Select Gender --</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group" style="padding:10px">
                        <label style="padding-bottom:10px;">Birthday</label>
                        <input type="date" class="form-control" name="birthday" id="birthday" placeholder="Birthday">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group" style="padding:10px">
                        <label style="padding-bottom:10px;">Contact</label>
                        <input type="text" class="form-control" name="contact" id="contact" placeholder="Contact">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group" style="padding:10px">
                        <label style="padding-bottom:10px;">Email</label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="Email">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group" style="padding:10px">
                        <label style="padding-bottom:10px;">Username</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group" style="padding:10px">
                        <label style="padding-bottom:10px;">Password</label>
                        <input type="text" class="form-control" name="password" id="password" placeholder="Password">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group" style="padding:10px">
                        <label style="padding-bottom:10px;">Clinic Address</label>
                        <input type="text" class="form-control" name="address" id="address" placeholder="Address">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group" style="padding:10px">
                        <label style="padding-bottom:10px;">Clinic City</label>
                        <input type="text" class="form-control" name="city" id="city" placeholder="City">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group" style="padding:10px">
                        <label style="padding-bottom:10px;">Clinic Zip</label>
                        <input type="text" class="form-control" name="zip" id="zip" placeholder="Zip">
                      </div>
                    </div>
                  </div>


                  <div class="d-flex justify-content-end" style="padding-top:20px;">
                    <button type="submit" name="submit" class="btn btn-success" style="margin-right:10px;"><i
                        class="fas fa-plus-square"></i>&nbsp;&nbsp;Add
                      Vet</button>
                    <a href="admin_vets.php" class="btn btn-primary">Go Back</a>
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