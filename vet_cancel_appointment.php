<?php
include './database/config.php';

$did = $_GET['id'];

$query = "UPDATE vet_appointment SET `status` = '1' WHERE appointment_id='$did'";
$query_run = mysqli_query($conn, $query);
    if ($query_run) {
      echo "<script> 
      alert('Appointment Cancelled');
      window.location.href='vet_appointments.php';
      </script>";
      
    } else {
      echo "<script>alert('Cannot Cancel Appointment.');
      window.location.href='vet_appointments.php';
      </script>";
    }
?>
