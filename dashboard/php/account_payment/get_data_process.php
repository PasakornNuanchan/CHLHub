<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';


$data_radio_select_type = $_POST['data_radio_select_type'] ? $_POST['data_radio_select_type'] : '';
$job_number = $_POST['job_number'] ? $_POST['job_number'] : '';


$sql_data_request_process = "
SELECT
	(SELECT GROUP_CONCAT(jt.job_number) FROM job_title jt WHERE find_in_set(jt.ID,(SELECT GROUP_CONCAT(b.ref_job_id) FROM billing b WHERE find_in_set(b.ID,bp.ref_billing)))) as job_number,
    (SELECT FORMAT(SUM(b.amtinclvat),2) FROM billing b WHERE find_in_set(b.ID,bp.ref_billing)) total_start,
    bp.ID,
    bp.ref_billing_id,
    bp.ref_job_id,
    bp.paid_by,
    bp.paid_date_time,
    bp.status_billing,
    FORMAT(bp.paid_amt,2) paid_amt,
    bp.document_payment,
    bp.type_document,
    bp.pay_at,
    bp.tranfer_method,
    FORMAT(bp.total_payment,2) total_payment,
    bp.bank_account,
    bp.payment_date,
    bp.write_off_date,
    bp.remark,
    bp.ref_billing,
    bp.currency_start,
    bp.currency_end,
    bp.hanler,
    (SELECT GROUP_CONCAT(u.first_name,' ',u.last_name) FROM user u WHERE find_in_set(u.ID,bp.hanler)) hanler_data,
    bp.sale,
    (SELECT GROUP_CONCAT(u.first_name,' ',u.last_name) FROM user u WHERE find_in_set(u.ID,bp.sale)) sale_data,
    (SELECT ba.bank_code FROM bank_account_corp ba WHERE bp.bank_account = ba.ID) bank_code,
    bp.consignee_name

FROM
    billing_payment bp
WHERE
    bp.type_document = '$data_radio_select_type'
ORDER BY
	ID DESC

    
";

$result = $con->query($sql_data_request_process);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $table[] = $row;
    }
} else {
    $table = "0 results";
}
echo json_encode(array('table' => $table));

?>