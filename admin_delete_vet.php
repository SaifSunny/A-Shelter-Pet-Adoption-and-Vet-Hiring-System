<?php
include './database/config.php';

$did = $_GET['id'];

$query = "DELETE FROM vets WHERE vet_id='$did'";
$query_run = mysqli_query($conn, $query);
    if ($query_run) {
      echo "<script> 
      alert('Vet has been Deleted.');
      window.location.href='admin_vets.php';
      </script>";
      
    } else {
      echo "<script>alert('Cannot Delete Vet');
      window.location.href='admin_vets.php';
      </script>";
    }
?>
