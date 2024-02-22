<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';

$data_radio_select_type = isset($_POST['data_sent']['data_radio_select_type']) ? $_POST['data_sent']['data_radio_select_type'] : '';
$data_document_number_search = isset($_POST['data_sent']['data_document_number_search']) ? $_POST['data_sent']['data_document_number_search'] : '';
$data_job_number_search = isset($_POST['data_sent']['data_job_number_search']) ? $_POST['data_sent']['data_job_number_search'] : '';
$data_currency_search = isset($_POST['data_sent']['data_currency_search']) ? $_POST['data_sent']['data_currency_search'] : '';
$data_bank_account_search = isset($_POST['data_sent']['data_bank_account_search']) ? $_POST['data_sent']['data_bank_account_search'] : '';
$data_active_cnee = isset($_POST['data_sent']['data_active_cnee']) ? $_POST['data_sent']['data_active_cnee'] : '';
$select_data_start = isset($_POST['data_sent']['select_data_start']) ? $_POST['data_sent']['select_data_start'] : '';
$select_data_end = isset($_POST['data_sent']['select_data_end']) ? $_POST['data_sent']['select_data_end'] : '';


if($data_radio_select_type != ''){
    $data_radio_select_type = "AND type_document =  '$data_radio_select_type'";
}
if($data_document_number_search != ''){
    $data_document_number_search = "AND document_payment = '$data_document_number_search'";
}
if($data_job_number_search != ''){
    $data_job_number_search = "AND data_job_number LIKE '%$data_job_number_search%'";
}
if($data_currency_search != ''){
    $data_currency_search = "AND currency_receipt =  '$data_currency_search'";
}
if($data_bank_account_search != ''){
    $data_bank_account_search = "AND bank_account = '$data_bank_account_search'";
}
if($data_active_cnee != ''){
    $data_active_cnee = "AND consignee_name = '$data_active_cnee'";
}

if($select_data_start != '' && $select_data_end != ''){
    $data_date = "AND payment_date BETWEEN '$select_data_start' AND '$select_data_end'";
}

$sql_data_table = "
SELECT
	if(bp.type_document = 'AR','Receivable','Payable') type_document,
    bp.document_payment,
	CONCAT((bp.document_payment),
    (SELECT COUNT(br.ID) FROM billing_receipt br WHERE br.ref_billing_payment = bp.ID),
    LPAD(ROW_NUMBER() OVER (PARTITION BY bp.document_payment ORDER BY bpl.ID),2,'0')) data_docuemnt,
    br.payment_date,
    bp.consignee_name,
    br.ref_billing_payment,
    br.currency_receipt,
    br.image_file,
    br.image_type,
    br.image_name,
	(SELECT GROUP_CONCAT(jt.job_number) FROM job_title jt WHERE FIND_IN_SET(jt.ID,  (SELECT GROUP_CONCAT(b.ref_job_id)FROM billing b WHERE FIND_IN_SET(b.ID,(SELECT GROUP_CONCAT(bpl.data_number_id) FROM billing_payment_list bpl WHERE bpl.id_refer_bp = br.ref_billing_payment))))) data_job_number,
	(SELECT ba.bank_code FROM bank_account_corp ba WHERE ba.ID = br.bank_account) bank_account_name,
    br.bank_account,
    br.actual_payment,
    bp.remark,
    br.ID
FROM
    billing_receipt br
    LEFT JOIN billing_payment bp ON bp.ID = br.ref_billing_payment
	LEFT JOIN billing_payment_list bpl ON bpl.id_refer_bp = bp.ID
GROUP BY
	br.ID
HAVING
1 = 1
$data_radio_select_type
$data_document_number_search
$data_job_number_search
$data_currency_search
$data_bank_account_search
$data_active_cnee
$data_date


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
