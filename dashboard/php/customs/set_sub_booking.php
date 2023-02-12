<?php
$job_number = $_POST['job_number'];
    include '../../core/conn.php';

      $sql_booking = "
      SELECT * FROM job_title WHERE job_number = '$job_number';";

      $sql_cn_inform = "
      SELECT * FROM container_information 
      LEFT JOIN hs_code ON container_information.hs_code = hs_code.hs_code WHERE job_number = '$job_number'";
 
$result = $con->query($sql_booking);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $booking = $row;
  }
} else {
  $booking = "0 results";
}

$result = $con->query($sql_cn_inform);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $cninform = $row;
  }
} else {
  $cninform = "0 results";
}

     echo json_encode(array('booking'=>$booking,'cninform'=>$cninform));
?>