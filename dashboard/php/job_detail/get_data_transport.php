<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';
//$data_id = 1;
$data_id = $_POST['data'];

$get_route = "
SELECT
    `ID`,
    `job_number`,
    `sup_number`,
    `truck_quantity`,
    `pick_con_empty_address`,
    `pick_con_empty_remark`,
    `pick_con_address`,
    `pick_con_remark`,
    `drop_con_address`,
    `drop_con_remark`,
    `drop_con_empty_address`,
    `drop_con_empty_remark`,
    `budget`,
    `cur`,
    `sent_line_datetime`,
    `sup_confirm`,
    `type_truck`,
    `remark`,
    `status`,
    `ref_job_id`
FROM
    `transport_booking`
WHERE
    ref_job_id = '$data_id'
";


$result = $con->query($get_route);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $get_route_data[] = $row;
    $get_driver_id[] = $row['ID'];
  }
} else {
  $get_route_data = "0 results";
  $get_driver_id = "0 results";
}



if($get_driver_id == "0 results"){
  $arr_get_contact = "0 results";
}else{
  $imp_set_driver = strval(implode(",",$get_driver_id));

  $get_contact_booking_transport = "
  SELECT
      `ID`,
      `Driver_name`,
      `phone_number`,
      `container_id`,
      `job_number`,
      `route_id`,
      `plate_number`,
      `container_id`,
      `status`,
      `ref_job_id`
  FROM
      `transport_contact`
  WHERE
      route_id IN($imp_set_driver) 

  ";

  $result = $con->query($get_contact_booking_transport);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $get_contact[] = $row;
    }
    foreach($get_contact as $k => $v){
      $arr_get_contact[$v['route_id']][] = $v;
  }
}
  // } else {
  //   $arr_get_contact = "0 results";
  // }
}


echo json_encode(array(
    'get_route_data'=>$get_route_data,
    'get_contact'=>$arr_get_contact));
