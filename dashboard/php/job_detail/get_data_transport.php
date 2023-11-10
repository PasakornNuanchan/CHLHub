<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';
//$data_id = 1;
$data_id = $_POST['data'];

$get_route = "
SELECT
    tb.ID,
    tb.job_number,
    tb.sup_number,
    tb.truck_quantity,
    tb.pick_con_empty_address,
    tb.pick_con_empty_remark,
    tb.pick_con_address,
    tb.pick_con_remark,
    tb.drop_con_address,
    tb.drop_con_remark,
    tb.drop_con_empty_address,
    tb.drop_con_empty_remark,
    tb.budget,
    tb.cur,
    tb.sent_line_datetime,
    tb.sup_confirm,
    tb.type_truck,
    tb.remark,
    tb.status,
    tb.ref_job_id,
    tb.ggpick_con_empty_address,
    tb.ggpick_con_address,
    tb.ggdrop_con_address,
    tb.ggdrop_con_empty_address,
    tb.container_assign,
    tb.hbl_assign
FROM
    transport_booking tb
WHERE
    ref_job_id = '$data_id'
";


$result = $con->query($get_route);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $get_route_data[] = $row;
    $get_driver_id[] = $row['ID'];
    $get_container_transport[] = $row['container_assign'];
    $get_hbl_transport[] = $row['hbl_assign'];
  }



  // print_r($get_container_transport);
  // print_r($get_hbl_transport);
  $get_container_transport = array_filter($get_container_transport);
  $get_hbl_transport = array_filter($get_hbl_transport);
  
  $get_container_transport = implode(',', $get_container_transport);
  $get_hbl_transport = implode(',', $get_hbl_transport);
} else {
  $get_route_data = "0 results";
  $get_driver_id = "0 results";
  $get_container_transport = "0 results";
  $get_hbl_transport = "0 results";
}


// print_r($get_container_transport);
// print_r($get_hbl_transport);




if ($get_container_transport != "0 results") {
    $sql_query_data_a = "
      SELECT
          c.ID,
          concat(c.container_number,' ',(SELECT ct.container_sub_type FROM container_type ct WHERE ct.container_type_name = c.container_type),' (',(SELECT ct.container_type_full_name FROM container_type ct WHERE ct.container_type_name = c.container_type),')') as data_container
      FROM
          container c
      WHERE
        c.ID IN ($get_container_transport)
      ";

    $result = $con->query($sql_query_data_a);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $get_data_container_assign[] = $row;
      }
    }else{
      $get_data_container_assign = "0 results";
    }
  }else{
    $get_data_container_assign = "0 results";
  }

  if ($get_hbl_transport != "0 results") {
    $sql_query_data_b = "
      SELECT
          bl.ID,
          bl.hbl
      FROM
          bl_title bl
      WHERE
          bl.ID IN($get_hbl_transport)
      ";
    $result = $con->query($sql_query_data_b);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $get_data_hbl_assign[] = $row;
      }
    }else{
      $get_data_hbl_assign = "0 results";
    }
  }else{
    $get_data_hbl_assign = "0 results";
  }




if ($get_driver_id == "0 results") {
  $arr_get_contact = "0 results";
} else {
  $imp_set_driver = strval(implode(",", $get_driver_id));

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
    foreach ($get_contact as $k => $v) {
      $arr_get_contact[$v['route_id']][] = $v;
    }
  }else{
    $arr_get_contact = "0 results";
  }
}


echo json_encode(array(
  'get_route_data' => $get_route_data,
  'get_contact' => $arr_get_contact,
  'get_data_container_assign' => $get_data_container_assign,
  'get_data_hbl_assign' => $get_data_hbl_assign,
));
