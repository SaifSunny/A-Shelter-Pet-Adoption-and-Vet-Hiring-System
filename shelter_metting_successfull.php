<?php
include './database/config.php';

$did = $_GET['id'];

$query = "UPDATE adoption_requests SET `status` = '1' WHERE request_id='$did'";
$query_run = mysqli_query($conn, $query);

$query2 = "SELECT pet_id from adoption_requests WHERE request_id='$did'";
$query_run2 = mysqli_query($conn, $query2);
$row=mysqli_fetch_assoc($query_run2);
$pet_id=$row['pet_id'];

$query1 = "UPDATE adoption SET `adopted` = '1' WHERE pet_id='$did'";
$query_run1 = mysqli_query($conn, $query1);

  if ($query_run && $query_run1) {   

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