<?php

include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';

$sql_query_data_transport = "
SELECT
    tb.ID,
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
    (SELECT COUNT(con.ID) FROM container con WHERE con.ref_job_id = tb.ref_job_id) as count_container,
    (SELECT jt.delivery_plan FROM job_title jt WHERE jt.ID = tb.ref_job_id) as delivery_date,
    (SELECT js.Cus_suc_datetime FROM job_status js WHERE js.ref_job_id = tb.ref_job_id) as clearance_date,
    (SELECT jt.job_number FROM job_title jt WHERE jt.ID = tb.ref_job_id) as job_number
FROM
    transport_booking tb
WHERE
    1";

$result = $con->query($sql_query_data_transport);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
    $task[] = $row;
    $get_container_assign[] = $row['container_assign'];
    }
} else {
    $task = "0 results";
}

$imp_get_container_assign = implode($get_container_assign);

$sql_query_container = "
SELECT
    con.ID,
    con.container_type,
    con.container_number,
    con.gw,
    con.ref_job_id,
    (SELECT concat(ct.container_type_name,' (',ct.container_type_full_name,')') FROM container_type ct WHERE ct.container_type_name = con.container_type) container_type_name
FROM
    container con
WHERE
    con.ID IN ($imp_get_container_assign)
";


$result = $con->query($sql_query_container);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $get_head_data_container[] = $row;
    }
  }else{
    $get_head_data_container = "0 results";
  }




echo json_encode(array('task'=>$task,'get_head_data_container'=>$get_head_data_container));

?>