<?php
include './database/config.php';

$did = $_GET['id'];

  $query = "UPDATE adoption SET `adopted` = '1' WHERE pet_id='$did'";
  $query_run = mysqli_query($conn, $query);

  if ($query_run) {   

    echo "<script> 
    alert('Congratulation on a Successfull Adoption.');
    window.location.href='shelter_home.php';
    </script>";
    

  }else{
    echo "<script>alert('Cannot Confirm Adoption Request');
      window.location.href='shelter_home.php';
      </script>";
  }
?>