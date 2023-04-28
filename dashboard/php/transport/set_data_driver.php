<?php
$job_number_id = $_POST['job_number_id'];
include '../../core/conn.php';

    
     $sql_driver = "
     SELECT 
     tc.ID,
     tc.Driver_name,
     tc.phone_number,
     c.ID as container_id,
     c.seal_number,
     tc.route_id
     
     FROM transport_contact as tc
     LEFT JOIN container as c ON tc.container_id = c.ID
     WHERE tc.ref_job_id = '$job_number_id' AND status NOT IN (1)";

  $result = $con->query($sql_driver);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $driver[] = $row;
      //$route[] = $row['route_id'];
    }
  } else {
    $driver = "0 result";
  }
 
  foreach ($driver as $k => $v) {
    $driver_arr[$v['route_id']][] = $v;
  }
 
        

      echo json_encode(array('driver'=>$driver_arr));
