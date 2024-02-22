<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';


$data = $_POST['data'] ? $_POST['data'] : '';


$sql_query_data_payment = "
SELECT
	bpl.ID as id_payment,
    bpl.id_refer_bp,
    bpl.amount as amount_bpl,
    bpl.currency as currency_bpl,
    bpl.status_list,
    bpl.currency_number,
    bp.ID,
    bp.billing_description,
    bp.job_number,
    bp.bill_to_type,
    bp.bill_to,
    bp.payble,
    bp.currency,
    bp.qty,
    bp.unit_price,
    bp.amount,
    bp.vat,
    bp.amtinclvat,
    bp.remark,
    bp.type,
    bp.create_by,
    bp.create_data_time,
    bp.check_by,
    bp.check_date_time,
    bp.action_paid_by,
    bp.action_paid_date_time,
    bp.approve_by,
    bp.approve_date_time,
    bp.delete_date_time,
    bp.delete_by,
    bp.status,
    bp.ref_job_id,
    bp.add_on,
    bp.last_update_by,
    bp.last_update_datetime,
    bp.sys_rate,
    bp.Billing_date,
    bp.sys_rate_currency,
    bp.tax_with_hold_by,
    bp.commit_sale,
    bp.tax_with_hold_date_time,
    bp.currency_main,
    bp.need_vat,
    bp.refer,
    bp.with_holding_tax,
    bp.paid_amt,
    bp.pre_approve_by,
    bp.pre_approve_dt,
    bp.pre_approve_status,
    (SELECT jt.job_number FROM job_title jt WHERE jt.ID = bp.ref_job_id) as job_number_data,
    (SELECT bd.billing_item_name FROM billing_description bd WHERE bd.ID = bp.billing_description) billing_des
FROM
    billing_payment_list bpl
    LEFT JOIN billing bp ON bp.ID = bpl.data_number_id
WHERE
    bpl.id_refer_bp = '$data'
";


$sql_query_data_receipt = "
SELECT
    br.ID,
    br.ref_billing_payment,
    br.image_type,
    br.image_name,
    br.currency_receipt,
    br.bank_account,
    br.payment_date,
    br.actual_payment
FROM
    billing_receipt br
WHERE
    br.ref_billing_payment = '$data'
";
// echo $sql_data_table;

$result = $con->query($sql_query_data_payment);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $list[] = $row;
    }
} else {
    $list = "0 results";
}

$result = $con->query($sql_query_data_receipt);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $receipt[] = $row;
    }
} else {
    $receipt = "0 results";
}
echo json_encode(array('list' => $list,'receipt'=>$receipt));
