<?php
include './database/config.php';

$did = $_GET['id'];

$query = "DELETE FROM users WHERE user_id='$did'";
$query_run = mysqli_query($conn, $query);
    if ($query_run) {
      echo "<script> 
      alert('user has been Deleted.');
      window.location.href='admin_users.php';
      </script>";
      
    } else {
      echo "<script>alert('Cannot Delete user');
      window.location.href='admin_users.php';
      </script>";
    }
?>
