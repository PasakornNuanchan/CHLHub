<?php
include '../../core/conn.php';

$data = $_POST['pipe_data'];



$sql_query_job_title = "
SELECT 
jt.*,
c.address,
c.consignee_name
FROM job_title jt
LEFT JOIN consignee c ON jt.consignee_number = c.ID
WHERE 
jt.ID = '$data'
";

$result = $con->query($sql_query_job_title);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $job_title = $row;
  }
} else {
  $job_title = "0 results";
}

$sql_query_container = "
SELECT * FROM container WHERE ref_job_id = '$data'
";

$result = $con->query($sql_query_container);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $container[] = $row;
  }
} else {
  $container = "0 results";
}

$sql_query_data_list = "
SELECT * FROM bl_list WHERE ref_job_id = '$data'
";

$result = $con->query($sql_query_data_list);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $bl_list[] = $row;
  }
} else {
  $bl_list = "0 results";
}


$sql_query_bl_title = "
SELECT * FROM bl_title WHERE ref_job_id = '$data'
";

$result = $con->query($sql_query_bl_title);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $bl_title = $row;
  }
} else {
  $bl_title = "0 results";
}

echo json_encode(array('job_title'=>$job_title,'container'=>$container,'bl_list'=>$bl_list,'bl_title'=>$bl_title))

?>