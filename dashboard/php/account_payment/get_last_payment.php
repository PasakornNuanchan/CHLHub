<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';


$data_radio_select_type = isset($_POST['data_radio_select_type']) ? $_POST['data_radio_select_type'] : '';
$data_payment_place = isset($_POST['data_payment_place']) ? $_POST['data_payment_place'] : '';

$data_date_now_date_year = date("Y");
$data_date_now_date_month = date("m");

$sql_data_get_last = "
SELECT
    `ID`,
    `ref_billing_id`,
    `ref_job_id`,
    `paid_by`,
    `paid_date_time`,
    `status_billing`,
    `paid_amt`,
    `document_payment`,
    `type_document`,
    `pay_at`
FROM
    `billing_payment`
WHERE
    type_document ='$data_radio_select_type'
    AND pay_at = '$data_payment_place'
";
$result = $con->query($sql_data_get_last);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $get_last = $row;
    }
    $get_sent = $get_last['document_payment'];
    $data_year = substr($get_sent, 4, 4);
    $data_month = substr($get_sent, 8, 2);
    $data_number = substr($get_sent, 10, 4);

    $runnumber = $data_number;

    if ($data_year != $data_date_now_date_year) {
        $data_year = $data_date_now_date_year;
    }

    if ($data_month != $data_date_now_date_month) {
        $data_month = $data_date_now_date_month;
        $runnumber = 0;
    }

    $runnumber++;
    $data_runnumber_document = str_pad($runnumber, 4, '0', STR_PAD_LEFT);
    $data_run = $data_year . $data_month . $data_runnumber_document;
} else {
    $data_run = $data_date_now_date_year.$data_date_now_date_month."0001";

}

echo json_encode($data_run);
// $get_sent = "ARTH2023120002";

// echo $data_date_now_date_year.$data_date_now_date_month;
// $data_run = '';
// if ($get_last != "0 results") {


    // echo $data_run;
// } else {
// }
// echo $data_run;

// echo json_encode($data_run);
