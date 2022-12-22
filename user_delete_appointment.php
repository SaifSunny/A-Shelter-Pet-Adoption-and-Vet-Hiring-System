<?php
include './database/config.php';

$did = $_GET['id'];

$query = "DELETE FROM vet_appointment WHERE appointment_id='$did'";
$query_run = mysqli_query($conn, $query);
    if ($query_run) {
      echo "<script> 
      alert('Appointment has been Deleted.');
      window.location.href='user_appointments.php';
      </script>";
      
    } else {
      echo "<script>alert('Cannot Delete Appointment');
      window.location.href='user_appointments.php';
      </script>";
    }
?>
