<?php
include './database/config.php';

$did = $_GET['id'];

  $query = "UPDATE shelter SET `verified` = '1' WHERE shelter_id='$did'";
  $query_run = mysqli_query($conn, $query);

  if ($query_run) {   

    echo "<script> 
    alert('Verification Successfull.');
    window.location.href='admin_shelters.php';
    </script>";
    

  }else{
    echo "<script>alert('Cannot Confirm verification Request');
      window.location.href='admin_shelters.php';
      </script>";
  }
?>