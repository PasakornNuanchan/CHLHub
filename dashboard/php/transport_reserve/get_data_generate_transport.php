<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';

$sql_query_data = "
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
    tb.hbl_assign,
    tb.up_supplier_by,
    tb.up_supplier_datetime,
    (SELECT ts.transport_sup_name FROM transport_sup ts WHERE ts.ID = tb.sup_number) as sup_transport,
    (SELECT COUNT(con.ID) FROM container con WHERE con.ref_job_id = tb.ref_job_id) as count_container,
    (SELECT jt.delivery_plan FROM job_title jt WHERE jt.ID = tb.ref_job_id) as delivery_date,
    (SELECT js.Cus_suc_datetime FROM job_status js WHERE js.ref_job_id = tb.ref_job_id) as clearance_date,
	  (SELECT jt.job_number FROM job_title jt WHERE tb.ref_job_id = jt.ID) as job_number_id
FROM
    `transport_booking` tb
WHERE
    1";

    $result = $con->query($sql_query_data);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $get_data_report[] = $row;
      }
    }else{
      $get_data_report = "0 results";
    }

    echo json_encode(array('get_data_report'=>$get_data_report))

?>