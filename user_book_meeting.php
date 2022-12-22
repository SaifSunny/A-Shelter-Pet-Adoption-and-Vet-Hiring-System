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
$user_img=$row['user_img'];
$user_id=$row['user_id'];


$id = $_GET['id'];


$sql = "SELECT * FROM adoption WHERE pet_id='$id'";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);
$pet_img=$row['pet_img'];
$pet_name=$row['pet_name'];
$shelter_id=$row['shelter_id'];

if(isset($_POST['submit'])){

    $time = $_POST['time'];
    $date = $_POST['date'];
    $message = $_POST['message'];
  
    $query = "SELECT * FROM adoption_requests WHERE user_id = '$user_id' AND pet_id = '$id' AND `date` = '$date' AND `time` = '$time'";
    $query_run = mysqli_query($conn, $query);
    if(!$query_run->num_rows > 0){

        $query = "SELECT * FROM adoption_requests WHERE pet_id = '$id' AND `date` = '$date' AND `time` = '$time'";
        $query_run = mysqli_query($conn, $query);
        if(!$query_run->num_rows > 0){
            $query2 = "INSERT INTO adoption_requests(`user_id`, shelter_id, pet_id, user_image, shelter_image, pet_image, `user_name`, shelter_name, pet_name, `date`, `time`, `message`)
            VALUES ('$user_id', '$shelter_id', '$id','$user_img', (SELECT `shelter_img` FROM shelter WHERE shelter_id='$shelter_id'),'$pet_img', '$username', (SELECT `shelter_name` FROM shelter WHERE shelter_id='$shelter_id'),'$pet_name', '$date', '$time','$message')";
            $query_run2 = mysqli_query($conn, $query2);
                    
            if ($query_run2) {
              $cls="success";
              $error = "Appointment Successfully Placed.";
            } 
            else {
              $cls="danger";
              $error = mysqli_error($conn);
            }
        }
        else{
            $cls="danger";
            $error ="Schedule Not Free. Select Another time.";
        }
    }else{
        $cls="danger";
        $error ="Meeting Already Placed.";
    }
  
  
  }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Book Meeting</title>

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

        <!-- ======= Appointment Section ======= -->
        <section id="appointment" class="appointment section-bg" style="padding:100px;">
            <div class="container">

                <div class="section-title">
                    <h2>Book an Meeting</h2>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="mt-3">
                            <div class="mb-3" style="font-size: 70px;">
                                <i class='bx bxs-user'></i>
                            </div>
                            <span class="h3">Call for an Emergency Service!</span>
                            <h2 class="text-color mt-3">+880-1651345623</h2>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="appoinment-wrap mt-5 mt-lg-0 pl-lg-5">
                            <h2 class="mb-2 title-color">Book a Meeting</h2>
                            <p class="mb-4">Enter your details to book your Meeting</p>
                            <form action="" method="post" role="form">
                                <div class="row">
                                    <div class="col-md-6 form-group mt-3">
                                        <label for="contact" style="padding-bottom:10px;">Meeting Date</label>
                                        <input type="date" name="date" class="form-control datepicker" id="date"
                                            placeholder="Meeting Date"  required>
                                    </div>
                                    <div class="col-md-6 form-group mt-3">
                                        <label for="contact" style="padding-bottom:10px;">Meeting Time</label>
                                        <input type="time" name="time" class="form-control datepicker" id="time"
                                            placeholder="Meeting Time"  required>
                                    </div>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="contact" style="padding-bottom:10px;">Message</label>
                                    <textarea class="form-control" name="message" rows="5"
                                        placeholder="Message (Optional)" required></textarea>
                                </div>
                                <div class="alert alert-<?php echo $cls;?>">
                                    <?php 
                                            if (isset($_POST['submit'])){
                                                echo $error;
                                            }
                                        ?>
                                </div>
                                <div class="text-center"><button class="appointment-btn" style="border:none"
                                        type="submit" name="submit">Make an
                                        Meeting</button></div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- End Appointment Section -->
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