<?php
session_start();
include '../../core/conn.php';
require '../../function/auth/get_session.php';
include '../../core/con_path.php';
include '../../function/auth/run_petty_cash_number.php';

$list_data = $_POST['save_arr_detail'];
$data_title = $_POST['save_arr_title'];

foreach ($data_title as $k => $v) {
    $get_sel_mt = isset($v['sel_tranfer_mt']) ? $v['sel_tranfer_mt'] : '';
}

$sql_user_query = "
    SELECT * FROM user WHERE ID = '$data_user'";

$result = $con->query($sql_user_query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $dat_u = $row;
    }
} else {
    $dat_u = "0 results";
}

json_encode(array('dat_u' => $dat_u));
$bank_number = $dat_u['bank_number'];
$bank_name = $dat_u['bank_name'];


foreach ($list_data as $k => $v) {
    $get_amount = isset($v['get_amount']) ? $v['get_amount'] : '';
    $get_currency = isset($v['get_currency']) ? $v['get_currency'] : '';
    $get_description = isset($v['get_description']) ? $v['get_description'] : '';


$sql_insert_detail =
        "
INSERT INTO `petty_cash_detail`(
    `petty_cash_number`,
    `job_number`,
    `amount`,
    `currency`,
    `pcd_status`
)
VALUES(
    '$run_doc',
    '$get_description',
    '$get_amount',
    '$get_currency',
    '0'
)
";

$status = $con->query($sql_insert_detail);
}


$sql_insert_title =
    "
INSERT INTO `petty_cash_title`(
    `petty_cash_number`,
    `request_by`,
    `datetime_request`,
    `tranfer_method`,
    `tranfer_bank_name`,
    `tranfer_bank_number`,
    `status_doc`
)
VALUES(
    '$run_doc',
    '$data_user',
    '$t_time_save',
    '$get_sel_mt',
    '$bank_name',
    '$bank_number',
    '0'
)
";

$status = $con->query($sql_insert_title);
echo json_encode($run_doc);

 //$status = $con->query($sql_add_list);
 //print_r($status);
