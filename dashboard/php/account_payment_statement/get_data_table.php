<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';

$data_radio_select_type = $_POST['data_sent']['data_radio_select_type'] ? $_POST['data_sent']['data_radio_select_type'] : '';
$data_document_number_search = $_POST['data_sent']['data_document_number_search'] ? $_POST['data_sent']['data_document_number_search'] : '';
$data_job_number_search = $_POST['data_sent']['data_job_number_search'] ? $_POST['data_sent']['data_job_number_search'] : '';
$data_currency_search = $_POST['data_sent']['data_currency_search'] ? $_POST['data_sent']['data_currency_search'] : '';
$data_bank_account_search = $_POST['data_sent']['data_bank_account_search'] ? $_POST['data_sent']['data_bank_account_search'] : '';
$data_active_cnee = $_POST['data_sent']['data_active_cnee'] ? $_POST['data_sent']['data_active_cnee'] : '';


if($data_radio_select_type != ''){
    $data_radio_select_type = "AND type_document =  '$data_radio_select_type'";
}
if($data_document_number_search != ''){
    $data_document_number_search = "AND document_payment = '$data_document_number_search'";
}
if($data_job_number_search != ''){
    $data_job_number_search = "AND job_number = '$data_job_number_search'";
}
if($data_currency_search != ''){
    $data_currency_search = "AND currency =  '$data_currency_search'";
}
if($data_bank_account_search != ''){
    $data_bank_account_search = "AND bank_account_data = '$data_bank_account_search'";
}
if($data_active_cnee != ''){
    $data_active_cnee = "AND consignee_name = '$data_active_cnee'";
}

$sql_data_table = "
SELECT
	if(bp.type_document = 'AR','Receivable','Payable') type_document,
	bp.document_payment,
	CONCAT((bp.document_payment),
    (SELECT COUNT(bpl.ID) FROM billing_payment_list bpl WHERE bpl.id_refer_bp = bp.ID),
    LPAD(ROW_NUMBER() OVER (PARTITION BY bp.document_payment ORDER BY bpl.ID),2,'0')) data_docuemnt,
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
    $data_radio_select_type
    $data_document_number_search
    $data_job_number_search
    $data_currency_search
    $data_bank_account_search
    $data_active_cnee
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
