<?php
include_once("./database/config.php");


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Animadoption</title>

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

  <!--  CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

  <!-- Navbar Start -->
  <?php include_once("./templates/header.php");?>
  <!-- Navbar end -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container">
      <h1>Welcome to Animadoption</h1>
      <h2>A reliable place where you can adopt and get all kinds <br> of care for your pets.</h2>
      <a href="#about" class="btn-get-started scrollto">Get Started</a>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us">
      <div class="container">

        <div class="row">
          <div class="col-lg-4 d-flex align-items-stretch">
            <div class="content">
              <h3>Why Choose Animadoption?</h3>
              <p>
                Animadoption is a reliable place where you can adopt and get all kinds of care for your pets. If you
                want to adopt a pet choose from the wide range of shelters to adopt your perfect pet. Want to visit a
                vet? Book appointments from our wide range of vet lists and book appointments quickly.
              </p>
              <div class="text-center">
                <a href="#" class="more-btn">Learn More <i class="bx bx-chevron-right"></i></a>
              </div>
            </div>
          </div>
          <div class="col-lg-8 d-flex align-items-stretch">
            <div class="icon-boxes d-flex flex-column justify-content-center">
              <div class="row">
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class='bx bx-home-alt'></i>
                    <h4>Shelters</h4>
                    <p>Sort through our Shelter list to find your nearby shelter address.</p>
                  </div>
                </div>
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class='bx bxs-cat'></i>
                    <h4>Adoption</h4>
                    <p>Adopt your perfect pet through our website.</p>
                  </div>
                </div>
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class='bx bx-plus-medical'></i>
                    <h4>Vets</h4>
                    <p>sort through our vet list to find your perfect vet and book appointment.</p>
                  </div>
                </div>
              </div>
            </div><!-- End .content-->
          </div>
        </div>

      </div>
    </section><!-- End Why Us Section -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about" style="Padding:100px;">
      <div class="container-fluid">

        <div class="section-title">
          <h2>About us</h2>
        </div>

        <div class="row align-items-center">
          <div class="col-lg-4 col-sm-6">
            <div class="about-img">
              <img src="assets/img/about/img-1.jpg" alt="" class="img-fluid">
              <img src="assets/img/about/img-2.jpg" alt="" class="img-fluid mt-4">
            </div>
          </div>
          <div class="col-lg-4 col-sm-6">
            <div class="about-img mt-4 mt-lg-0">
              <img src="assets/img/about/img-3.jpg" alt="" class="img-fluid">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="about-content pl-4 mt-4 mt-lg-0">
              <h2 class="title-color">Choose your<br>Perfect Pet</h2>
              <p class="mt-4 mb-5">We help you in choosing the perfect pet for your household via browsing
                through 100's of shelters.</p>
              <a href="shelters.php" class="appointment-btn scrollto" style="margin:0;">Adopt Now</a>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
      <div class="container">

        <div class="row">

          <div class="col-lg-3 col-md-6">
            <div class="count-box">
            <?php
                                    $sql = "SELECT * from users";
                                    $result = mysqli_query($conn, $sql);
                                    $row_cnt = $result->num_rows;
                                ?>
              <i class="fas fa-users"></i>
              <span data-purecounter-start="0" data-purecounter-end="<?php echo $row_cnt?>" data-purecounter-duration="1"
                class="purecounter"></span>
              <p>Users</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
            <div class="count-box">
              <i class="fa-solid fa-dog"></i>
              <?php
                                    $sql = "SELECT * from adoption_requests where status=1";
                                    $result = mysqli_query($conn, $sql);
                                    $row_cnt = $result->num_rows;
                                ?>
              <span data-purecounter-start="0" data-purecounter-end="<?php echo $row_cnt?>" data-purecounter-duration="1"
                class="purecounter"></span>
              <p>Adoptions</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
            <div class="count-box">
              <i class="fas fa-user-md"></i>
              <?php
                                    $sql = "SELECT * from vets where status=1";
                                    $result = mysqli_query($conn, $sql);
                                    $row_cnt = $result->num_rows;
                                ?>
              <span data-purecounter-start="0" data-purecounter-end="<?php echo $row_cnt?>" data-purecounter-duration="1"
                class="purecounter"></span>
              <p>Vets</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
            <div class="count-box">
              <i class="fas fa-coins"></i>
              <?php
                                    $sql = "SELECT * from shelter where verified=1";
                                    $result = mysqli_query($conn, $sql);
                                    $row_cnt = $result->num_rows;
                                ?>
              <span data-purecounter-start="0" data-purecounter-end="<?php echo $row_cnt?>" data-purecounter-duration="1"
                class="purecounter"></span>
              <p>Shelters</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Counts Section -->

    <!-- ======= Shelter Section ======= -->
    <section id="shelters" class="appointment section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Our Shelters</h2>
        </div>
        <div class="row">
          <?php
            $sql = "SELECT * FROM shelter WHERE `verified` ='1' LIMIT 3";
            $result = mysqli_query($conn, $sql);
            if($result){
              while($row=mysqli_fetch_assoc($result)){
                                  
                $name=$row['shelter_name'];
                $address=$row['address'] ." ". $row['city']."-". $row['zip'];;
                $image=$row['shelter_img'];
                $contact=$row['contact'];
                $email=$row['email'];
                $shelter_id=$row['shelter_id'];
          ?>
          <div class="col-md-4 form-group ">
            <div class="department-block mb-5 card" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2)">
              <a href="user_shelter_profile.php?id=<?php echo $shelter_id?>"><img src="assets/img/shelters/<?php echo $image?>" alt=""
                  class="img-fluid w-100"></a>

              <div class="content card-body" style="padding:10px 0px 30px 30px;">
                <h4 class="mt-4 " style="padding-bottom:8px;"><?php echo $name?></h4>
                <span class="mb-4"
                  style="padding:5px;background:#222;border-radius:10px;font-size:12px;padding:6px;color:white;margin-bottom:20px;">Pet
                  Adpotion</span>
                <span class="mb-4"
                  style="padding:5px;background:#5cb85c;border-radius:10px;font-size:12px;padding:6px;color:white;margin-bottom:10px;">Pet
                  Vaccination</span>

                <p style="padding-top:20px;"> <i class="fa-solid fa-location-dot"></i> <?php echo $address?></p>
                <p><i class="fa-solid fa-paw"></i> Cats, Dogs, Rabits </p>

              </div>
            </div>
          </div>
          <?php
              }
            }
          ?>
        </div>

        <div class="text-center">See All</div>

      </div>
    </section><!-- End Shelter Section -->




    <!-- ======= Vet Section ======= -->
    <section id="vets" class="doctors">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="section-title text-center">
              <h2 class="mb-4">Our Vets</h2>
              <div class="divider mx-auto my-4"></div>
            </div>
          </div>
        </div>

        <div class="row">
          <?php
            $sql = "SELECT * FROM vets WHERE `status` ='1' LIMIT 4";
            $result = mysqli_query($conn, $sql);
            if($result){
              while($row=mysqli_fetch_assoc($result)){
                                  
                $name=$row['firstname'] ." ". $row['lastname'];
                $edu=$row['education1'] ." / ". $row['education2'];
                $image=$row['image'];
                $vet_id=$row['vet_id'];

                $sql1 = "SELECT * FROM vet_ratings WHERE vet_id = '$vet_id'";
                $result1 = mysqli_query($conn, $sql1);
                $count = $result1->num_rows;
                        
                $query2 = "SELECT AVG(rating) AS average FROM vet_ratings WHERE vet_id = '$vet_id'";
                $result2 = mysqli_query($conn, $query2);
                $row2 = mysqli_fetch_assoc($result2);
                $avg = $row2['average'];
          ?>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="team-block mb-5 mb-lg-0">
              <img src="assets/img/doctors/<?php echo $image?>" alt="" class="img-fluid w-100">

              <div class="content">
                <h4 class="mt-4 mb-0"><a href="user_vet_profile.php?id=<?php echo $vet_id?>"><?php echo $name?></a></h4>
                <p><?php echo $edu?></p>
                <h6 class="m-0"><i class="fa fa-star" style="color:gold;"></i>
                    <?php echo strlen(substr(strrchr($avg, "."), 2))?>
                    <small>(<?php echo $count?>) Ratings</small>
                  </h6>
              </div>
            </div>
          </div>
          <?php
              }
            }
          ?>
        </div>
      </div>
      <div class="row text-center" style="padding-top:40px;">
        <h5> <a href="vets.php">See All</a></h5>
      </div>
    </section><!-- End Doctors Section -->


    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="section-title text-center">
              <h2 class="mb-4">Testimonials</h2>
              <div class="divider mx-auto my-4"></div>
            </div>
          </div>
        </div>
        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-wrap">
                <div class="testimonial-item">
                  <img src="assets/img/testimonials/testi1.jpg" class="testimonial-img" alt="">
                  <h3>Md Abdul Matin</h3>
                  <h4>CEO</h4>
                  <p>
                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                    Adopted dog from the shelter. All the informations were real.
                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                  </p>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-wrap">
                <div class="testimonial-item">
                  <img src="assets/img/testimonials/testi2.jpg" class="testimonial-img" alt="">
                  <h3>Sara Ahmed</h3>
                  <h4>Designer</h4>
                  <p>
                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                    Saved my time by helping me to find a vet for my puppy.
                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                  </p>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-wrap">
                <div class="testimonial-item">
                  <img src="assets/img/testimonials/testi2.jpg" class="testimonial-img" alt="">
                  <h3>Jubairia Islam</h3>
                  <h4>Store Owner</h4>
                  <p>
                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                    Went to the shelters to spend some times with the animals. I enjoyed so much. This site helpsme in
                    finding nearby shelter.
                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                  </p>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-wrap">
                <div class="testimonial-item">
                  <img src="assets/img/testimonials/testi1.jpg" class="testimonial-img" alt="">
                  <h3>Mohammad Yusuf</h3>
                  <h4>Freelancer</h4>
                  <p>
                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                    Make my life easier by helping me find a pet. Very cordial.
                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                  </p>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-wrap">
                <div class="testimonial-item">
                  <img src="assets/img/testimonials/testi2.jpg" class="testimonial-img" alt="">
                  <h3>Anika Ibnat</h3>
                  <h4>Entrepreneur</h4>
                  <p>
                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                    I went to the shelter to get my dog vaccinated. They are very professional. Thanks to this useful
                    site.
                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                  </p>
                </div>
              </div>
            </div><!-- End testimonial item -->

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Testimonials Section -->


    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <h2>Contact</h2>
        </div>
      </div>

      <div class="container">
        <div class="row mt-5">
          <div class="col-lg-4">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Location:</h4>
                <p>Dhaka, Bangladesh</p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>animadoption@gmail.com</p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Call:</h4>
                <p>+880 1315609784</p>
              </div>

            </div>

          </div>

          <div class="col-lg-8 mt-5 mt-lg-0">

            <form action="contact.php" method="post" class="php-email-form">
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
              </div>
              <div class="text-center"><button type="submit" name="submit">Send Message</button></div>
            </form>

          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

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