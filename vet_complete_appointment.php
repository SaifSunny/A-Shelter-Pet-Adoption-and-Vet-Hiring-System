<?php
include './database/config.php';

$did = $_GET['id'];

$query = "UPDATE vet_appointment SET `status` = '2' WHERE appointment_id='$did'";
$query_run = mysqli_query($conn, $query);
    if ($query_run) {
      echo "<script> 
      alert('Congrats on Completing the Appointment');
      window.location.href='vet_appointments.php';
      </script>";
      
    } else {
      echo "<script>alert('Cannot Mark as Complete.');
      window.location.href='vet_appointments.php';
      </script>";
    }
?>
