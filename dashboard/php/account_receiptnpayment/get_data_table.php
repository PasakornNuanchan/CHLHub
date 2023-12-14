<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';



$sql_data_table = "
    SELECT
    b.ID,
    (SELECT bd.billing_item_name FROM billing_description bd WHERE b.billing_description = bd.ID) as billing_description,
    (SELECT jt.job_number FROM job_title jt WHERE b.ref_job_id = jt.ID) as job_number,
    b.bill_to_type,
    b.bill_to,
    b.billing_description as billing_des_id,
    (SELECT c.consignee_name FROM consignee c WHERE c.ID = b.bill_to) as bill_to_c,
    b.payble,
    b.currency,
    b.qty,
    b.unit_price,
    b.amount,
    b.vat,
    b.amtinclvat,
    b.remark,
    b.type,
    (SELECT u1.first_name FROM user u1 WHERE b.create_by = u1.ID) create_by_f,
    (SELECT u1.last_name FROM user u1 WHERE b.create_by = u1.ID) create_by_l,
    b.create_data_time,
    b.check_by,
    (SELECT u2.first_name FROM user u2 WHERE b.check_by = u2.ID) check_by_f,
    (SELECT u2.last_name FROM user u2 WHERE b.check_by = u2.ID) check_by_l,
    b.check_date_time,
    b.action_paid_by,
    (SELECT u3.first_name FROM user u3 WHERE b.action_paid_by = u3.ID) action_paid_by_f,
    (SELECT u3.last_name FROM user u3 WHERE b.action_paid_by = u3.ID) action_paid_by_l,
    b.action_paid_date_time,
    b.approve_by,
    b.approve_date_time,
    b.delete_date_time,
    b.delete_by,
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
    b.paid_amt,
    b.pre_approve_by,
    b.pre_approve_dt,
    b.pre_approve_status,
    (SELECT u4.first_name FROM user u4 WHERE u4.ID = (SELECT jt.cs_support FROM job_title jt WHERE b.ref_job_id = jt.ID)) as cs_support_f,
    (SELECT u4.last_name FROM user u4 WHERE u4.ID = (SELECT jt.cs_support FROM job_title jt WHERE b.ref_job_id = jt.ID)) as cs_support_l,
    (SELECT u5.first_name FROM user u5 WHERE u5.ID = (SELECT jt.sale_support FROM job_title jt WHERE b.ref_job_id = jt.ID)) as sale_support_f,
    (SELECT u5.first_name FROM user u5 WHERE u5.ID = (SELECT jt.sale_support FROM job_title jt WHERE b.ref_job_id = jt.ID)) as sale_support_l,
    (SELECT u6.first_name FROM user u6 WHERE b.approve_by = u6.ID) approve_by_f,
    (SELECT u6.last_name FROM user u6 WHERE b.approve_by = u6.ID) approve_by_l,
    (SELECT jt.booking_number FROM job_title jt WHERE jt.ID = b.ref_job_id) booking_no,
    (SELECT GROUP_CONCAT(con.container_number) FROM container con WHERE b.ref_job_id = con.ref_job_id) container
    FROM
    billing b
    WHERE
    b.type = 'AR' 
    AND b.status = '2'
";
// echo $sql_data_table;

$result = $con->query($sql_data_table);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $table[] = $row;
    }
} else {
    $table = "0 results";
}
echo json_encode(array('table' => $table));
