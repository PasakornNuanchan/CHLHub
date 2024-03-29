<?php

include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';
$id_number = $_POST['id_number'];
$sql_request_data_billing = "
SELECT
    bp.paid_date_time,
    bi.*,
    cb.first_name cbfn,
    cb.last_name cbln,
    cb.brunch cbb,
    ccb.first_name ccbfn,
    ccb.last_name ccbln,
    apb.first_name apbfn,
    apb.last_name apbln,
    lub.first_name lubfn,
    lub.last_name lubln,
    bpl.amount as amount_bpl,
    bpl.currency as currency_bpl,
    app.first_name appfn,
    app.last_name appln,
    sra.usd_thb,
    sra.usd_rmb,
    sra.usd_yen,
    sra.thb_usd,
    sra.thb_rmb,
    sra.thb_yen,
    sra.rmb_usd,
    sra.rmb_thb,
    sra.rmb_yen,
    sra.yen_usd,
    sra.yen_thb,
    sra.yen_rmb
FROM
    billing bi
LEFT JOIN USER cb ON
    cb.ID = bi.create_by
LEFT JOIN USER ccb ON
    ccb.ID = bi.check_by
LEFT JOIN USER apb ON
    apb.ID = bi.action_paid_by
LEFT JOIN USER lub ON
    lub.ID = bi.last_update_by
LEFT JOIN USER app ON
    app.ID = bi.approve_by
LEFT JOIN billing_payment bp ON bp.ref_billing_id = bi.ID
LEFT JOIN billing_payment_list bpl ON bpl.data_number_id = bi.ID 
LEFT JOIN sys_rate_cur sra ON sra.ID = bpl.currency_number
WHERE
    bi.type = 'AP' AND bi.ref_job_id = '$id_number'
";

$result = $con->query($sql_request_data_billing);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $get_data_ap[] = $row;
  }
} else {
  $get_data_ap = "0 results";
}

echo json_encode(array('get_data_ap'=>$get_data_ap))

?>