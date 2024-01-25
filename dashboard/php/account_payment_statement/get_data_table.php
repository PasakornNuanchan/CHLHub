<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';

$data_radio_select_type = isset($_POST['data_radio_select_type']) ? $_POST['data_radio_select_type'] : '';
$data_data_id = isset($_POST['data_data_id']) ? $_POST['data_data_id'] : '';
$data_data_type = isset($_POST['data_data_type']) ? $_POST['data_data_type'] : '';
$data_name_type = isset($_POST['data_name_type']) ? $_POST['data_name_type'] : '';
$job_number = isset($_POST['job_number']) ? $_POST['job_number'] : '';

$sql_data_table = "
SELECT
	if(bp.type_document = 'AR','Receivable','Payable') type_document,
	bp.document_payment,
	CONCAT((bp.document_payment),(SELECT COUNT(bpl.ID) FROM billing_payment_list bpl WHERE bpl.id_refer_bp = bp.ID),LPAD(ROW_NUMBER() OVER (PARTITION BY bp.document_payment ORDER BY bpl.ID),2,'0')) data_docuemnt,
    bp.payment_date,
    bp.consignee_name,
    (SELECT jt.job_number FROM job_title jt WHERE jt.ID = (SELECT b.ref_job_id FROM billing b WHERE bpl.data_number_id = b.ID)) job_number,
    bpl.currency,
    FORMAT(bpl.amount,2) amount,
    (SELECT bac.bank_code FROM bank_account_corp bac WHERE bac.ID = bp.bank_account) bank_account_data,
    bp.remark
FROM
    billing_payment bp
LEFT JOIN billing_payment_list bpl ON bpl.id_refer_bp = bp.ID
HAVING
	bp.document_payment IS NOT NULL
ORDER BY
	bp.ID DESC,
	bpl.ID ASC


";

$result = $con->query($sql_data_table);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $table[] = $row;
    }
} else {
    $table = "0 results";
}
echo json_encode(array('table' => $table));
