<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';

$sql_query_data = "
SELECT
    b.ID,
    (SELECT job_number FROM job_title WHERE ID = b.ref_job_id) job_number,
    jt.cs_support,
    (SELECT concat(first_name,' ',last_name) FROM user WHERE ID = jt.cs_support) cs_support_name,
    (SELECT concat(first_name,' ',last_name) FROM user WHERE ID = jt.sale_support) sale_support_name,
    (SELECT concat(first_name,' ',last_name) FROM user WHERE ID = b.create_by) create_by_name,
    (SELECT concat(first_name,' ',last_name) FROM user WHERE ID = b.check_by) check_by_name,
    (SELECT bd.billing_item_name FROM billing_description bd WHERE b.billing_description = bd.ID) billing_des_name,
    if(b.bill_to_type = '1',(SELECT gc.name FROM Goverment_contact gc WHERE gc.ID = b.bill_to),
    (SELECT car.carrier_name FROM carrier car WHERE car.ID = b.bill_to)) as bill_to_c,
    GROUP_CONCAT(c1.container_number) container_data,
    GROUP_CONCAT(bl.hbl) hbl_data,
    jt.booking_number,
    jt.create_date,
    b.bill_to_type,
    b.bill_to,
    b.payble,
    b.currency,
    b.qty,
    b.unit_price,
    b.amount,
    b.vat,
    b.amtinclvat,
    b.remark,
    b.type,
    b.create_data_time,
    b.create_by,
    b.delete_date_time,
    b.delete_by,
    b.action_paid_by,
    b.action_paid_date_time,
    b.check_by,
    b.check_date_time,
    b.status,
    b.ref_job_id,
    b.add_on,
    b.last_update_by,
    b.last_update_datetime,
    b.sys_rate,
    b.Billing_date,
    b.sys_rate_currency,
    b.tax_with_hold_by,
    b.commit_sale,
    b.tax_with_hold_date_time,
    b.currency_main,
    b.need_vat,
    b.refer,
    b.with_holding_tax,
    b.paid_amt
FROM
    `billing` b
    LEFT JOIN job_title jt ON jt.ID = b.ref_job_id
    LEFT JOIN container c1 ON b.ref_job_id = c1.ref_job_id
    LEFT JOIN bl_title bl ON b.ref_job_id = bl.ref_job_id
WHERE
    b.type = 'AP'
GROUP BY
	b.ID
";
$result = $con->query($sql_query_data);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $table[] = $row;
  }
} else {
  $table = "0 results";
}

echo json_encode(array('table'=>$table))

?>



