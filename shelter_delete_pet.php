<?php
include './database/config.php';

$did = $_GET['id'];

$query = "DELETE FROM adoption WHERE pet_id='$did'";
$query_run = mysqli_query($conn, $query);
    if ($query_run) {
      echo "<script> 
      alert('Pet has been Deleted.');
      window.location.href='shelter_home.php';
      </script>";
      
    } else {
      echo "<script>alert('Cannot Delete Pet');
      window.location.href='shelter_home.php';
      </script>";
    }
?>
