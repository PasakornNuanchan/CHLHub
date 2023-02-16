<?php
session_start();
include '../../core/conn.php';
include '../../core/con_path.php';
include '../../function/auth/run_petty_cash_number.php';
$list_data = $_POST['save_arr_detail'];
$data_title = $_POST['save_arr_title'];
//echo $t_time_save;



foreach ($list_data as $k => $v) {
    $get_amount = isset($v['get_amount']) ? $v['get_amount'] : '';
    $get_currency = isset($v['get_currency']) ? $v['get_currency'] : '';
    $get_description = isset($v['get_description']) ? $v['get_description'] : '';


   echo $sql_insert_detail =
        "
INSERT INTO `petty_cash_detail`(
    `petty_cash_number`,
    `job_number`,
    `amount`,
    `currency`
)
VALUES(
    '$run_doc',
    '$get_description',
    '$get_amount',
    '$get_currency'
)
";
    //echo $sql_insert_list;
}


$sql_insert_title = 
"
INSERT INTO `petty_cash_title`(
    `petty_cash_number`,
    `request_by`,
    `datetime_request`,
    `total_amount_request`,
    `total_amount_request_cur`,
    `tranfer_method`,
    `tranfer_bank_name`,
    `tranfer_bank_number`
    `status_doc`
)
VALUES(
    '$run_doc',
    '$data_user',
    '$t_time_save',
    '[value-4]',
    '[value-5]',
    '[value-6]',
    '[value-7]'
)
";

 //$status = $con->query($sql_add_list);
 //print_r($status);
