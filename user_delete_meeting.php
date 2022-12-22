<?php
include './database/config.php';

$did = $_GET['id'];

$query = "DELETE FROM adoption_requests WHERE request_id='$did'";
$query_run = mysqli_query($conn, $query);
    if ($query_run) {
      echo "<script> 
      alert('Meeting has been Deleted.');
      window.location.href='user_home.php';
      </script>";
      
    } else {
      echo "<script>alert('Cannot Delete Meeting');
      window.location.href='user_home.php';
      </script>";
    }
?>
