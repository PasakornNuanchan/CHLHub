<?php
include '../../core/conn.php';

$data = $_POST['data'];

$sql_job_detail = "
SELECT
    jt.ID,
    jt.job_number,
    jt.consignee_number,
    jt.booking_number,
    jt.shipper_number,
    jt.st_number,
    jt.mbl,
    jt.hbl,
    jt.inv,
    jt.mother_vessel,
    jt.voy_no_mother,
    jt.feeder_vessel,
    jt.voy_no_feeder,
    jt.etd,
    jt.eta,
    jt.clearlance_date,
    jt.delivery_date,
    jt.check_document,
    jt.enter_date,
    jt.payment_date,
    jt.pickup_DO_date,
    jt.type_import_export,
    jt.remark,
    jt.create_date,
    jt.status_job,
    jt.sale_support,
    jt.last_save_by,
    jt.booking_agent,
    jt.customs_broker,
    jt.terminal,
    jt.bill_to_type,
    jt.ref_quo,
    jt.shipping_ass,
    c.consignee_name,
    s.shipper_name,
    ca.carrier_name,
    a1.location_name as a1l,
    a1.provice as a1p,
    a2.location_name as a2l,
    a2.provice as a2p, 
    a3.location_name as a3l,
    a3.provice as a3p,
    a4.location_name as a4l,
    a4.provice as a4p,
    st.st_name
FROM
    job_title jt
LEFT JOIN consignee c ON
    c.ID = jt.consignee_number
LEFT JOIN shipper s ON
    s.ID = jt.shipper_number
LEFT JOIN carrier ca ON
    ca.ID = jt.carrier_number
LEFT JOIN shipment_term st ON
    st.ID = jt.st_number
LEFT JOIN AREA a1 ON
    jt.port_of_receipt_number = a1.ID
LEFT JOIN AREA a2 ON
    jt.port_of_loading_number = a2.ID
LEFT JOIN AREA a3 ON
    jt.ts_port_number = a3.ID
LEFT JOIN AREA a4 ON
    jt.port_of_delivery_number = a4.ID
WHERE
    jt.ID = '$data'
";

$sql_job_status = "
SELECT
    js.ID,
    js.INV_receiv_by,
    js.PL_receiv_by,
    js.BL_receiv_by,
    js.ID_receiv_by,
    js.IL_receiv_by,
    js.Cus_suc_datetime,
    js.Cus_by,
    js.Cus_status,
    js.cus_pro,
    js.inv_receiv_datetime,
    js.inv_check_datetime,
    js.bl_receiv_datetime,
    js.bl_check_datetime,
    js.pl_receiv_datetime,
    js.pl_check_datetime,
    js.id_receiv_datetime,
    js.id_check_datetime,
    js.il_receiv_datetime,
    js.il_check_datetime,
    js.ref_job_id,
    js.ship_arrievd_st,
    js.ship_arrievd_by,
    js.ship_arrived_status,
    js.ship_pro,
    js.drop_status,
    js.drop_datetime,
    js.drop_by,
    js.drop_pro,
    js.cy_pro,
    js.cy_rtn,
    js.cy_rtn_by,
    js.cy_rtn_status,
    u.first_name,
    u.last_name
FROM
    job_status js
    LEFT JOIN user u ON js.Cus_by = u.ID
WHERE
    js.ref_job_id = '$data'
";

$sql_data_container = "
SELECT
	COUNT(ID) total_count,
    COUNT(CASE WHEN up_status_cntr = '1' THEN '1' ELSE NULL END) as count_up,
    COUNT(CASE WHEN cntr_status_ar = '1' THEN '1' ELSE NULL END) as count_ar
FROM
    `container`
WHERE
    ref_job_id = '$data'
";

$sql_billing_data = "
SELECT * FROM billing WHERE ref_job_id = '54'
";


$result = $con->query($sql_job_detail);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $job_detail = $row;
  }
} else {
  $job_detail = "0 results";
}

$result = $con->query($sql_job_status);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $job_detail_status = $row;
  }
} else {
  $job_detail_status = "0 results";
}

$result = $con->query($sql_data_container);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $data_container[] = $row;
  }
} else {
  $data_container = "0 results";
}

$result = $con->query($sql_billing_data);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $billing_data[] = $row;
  }
} else {
  $billing_data = "0 results";
}


echo json_encode(array('job_detail'=>$job_detail,'job_detail_status'=>$job_detail_status,'data_container'=>$data_container,'billing_data'=>$billing_data))

?>