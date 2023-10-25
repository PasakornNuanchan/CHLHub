<?php
include '../../core/conn.php';

$id_number = $_POST['id_number'];

$sql_get_data_transport = "
SELECT
    `pick_con_empty_address`,
    `pick_con_empty_remark`,
    `pick_con_address`,
    `pick_con_remark`,
    `drop_con_address`,
    `drop_con_remark`,
    `drop_con_empty_address`,
    `drop_con_empty_remark`,
    `ggpick_con_empty_address`,
    `ggpick_con_address`,
    `ggdrop_con_address`,
    `ggdrop_con_empty_address`
FROM
    `transport_booking`
WHERE
    ID = '$id_number'
";


$sql_get_driver = "
SELECT
    tc.ID,
    tc.Driver_name,
    tc.phone_number,
    tc.container_id,
    tc.job_number,
    tc.route_id,
    tc.status,
    tc.ref_job_id,
    tc.plate_number,
    c.container_number,
    c.up_datetime_cntr,
    c.cy_datetime_cntr,
    c.cntr_datetime,
    c.ID as container_id_data
FROM
    `transport_contact` tc
LEFT JOIN container c ON tc.container_id = c.ID
WHERE
  route_id = '$id_number'";

$result = $con->query($sql_get_driver);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $get_driver[] = $row;
  }
} else {
  $get_driver = "0 results";
}

$result = $con->query($sql_get_data_transport);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $get_data_transport[] = $row;
  }
} else {
  $get_data_transport = "0 results";
}

echo json_encode(array('get_data_transport'=>$get_data_transport,'get_driver'=>$get_driver))
?>