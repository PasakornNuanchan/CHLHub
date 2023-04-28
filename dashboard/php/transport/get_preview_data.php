<?php
$job_number_id = $_POST['job_number_id'];
include '../../core/conn.php';

$sql_container = "
      SELECT * FROM container WHERE ref_job_id = '$job_number_id';";

$sql_booking = "
      SELECT * FROM job_title WHERE ID = '$job_number_id';";


$sql_cn_inform = "
      SELECT 
        `cn`.`cargo`,
        `hs`.`hs_code`,
        `hs`.`hs_decription`,
        `cn`.`cargo_type`,
        `cn`.`quantity`,
        `cn`.`gw`,
        `cn`.`volume`,
        `cn`.`mark`

      FROM 
        container_information as cn 
        LEFT JOIN hs_code as hs ON cn.hs_code = hs.ID
        WHERE cn.ref_job_id = '$job_number_id';";


$result = $con->query($sql_container);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $cont[] = $row;
  }
} else {
  $cont[] = "0 results";
}

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



echo json_encode(array('cont' => $cont, 'booking' => $booking, 'cninform' => $cninform));
