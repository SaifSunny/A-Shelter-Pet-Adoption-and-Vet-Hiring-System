<?php
include './database/config.php';

$did = $_GET['id'];

$query = "DELETE FROM shelter WHERE shelter_id='$did'";
$query_run = mysqli_query($conn, $query);
    if ($query_run) {
      echo "<script> 
      alert('Shelter has been Deleted.');
      window.location.href='admin_shelters.php';
      </script>";
      
    } else {
      echo "<script>alert('Cannot Delete Shelter');
      window.location.href='admin_shelters.php';
      </script>";
    }
?>
