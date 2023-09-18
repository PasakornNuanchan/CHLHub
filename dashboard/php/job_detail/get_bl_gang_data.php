<?php
include '../../core/conn.php';

$id_number = $_POST['id_number'];

$sql_query_data_bl = "
SELECT 
bl.*,
jt.feeder_vessel,
jt.mother_vessel,
jt.port_of_receipt_number,
jt.port_of_loading_number,
jt.port_of_discharge,
jt.port_of_delivery_number	
FROM bl_title bl
LEFT JOIN job_title jt ON jt.ID = bl.ref_job_id
WHERE ref_job_id = '$id_number'
";

$result = $con->query($sql_query_data_bl);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $bl_title[] = $row;
  }
} else {
  $bl_title = "0 results";
}

$sql_query_data_list = "
SELECT * FROM bl_list WHERE ref_job_id = '$id_number'
";

$result = $con->query($sql_query_data_list);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $bl_list[] = $row;
  }
} else {
  $bl_list = "0 results";
}

$sql_query_container = "
SELECT * FROM container WHERE ref_job_id = '$id_number'
";

$result = $con->query($sql_query_container);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $container[] = $row;
  }
} else {
  $container = "0 results";
}


$sql_request_fright = "
SELECT * FROM fright_bl WHERE ref_job_id = '$id_number'
";

$result = $con->query($sql_request_fright);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $fright[] = $row;
  }
} else {
  $fright = "0 results";
}


echo json_encode(array('bl_title'=>$bl_title,'bl_list'=>$bl_list,'container'=>$container,'fright'=>$fright))
?>