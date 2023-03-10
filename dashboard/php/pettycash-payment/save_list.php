<?php
session_start();
include '../../core/conn.php';
require '../../function/auth/get_session.php';
include '../../core/con_path.php';
include '../../function/auth/run_petty_cash_number.php';
$list_data = $_POST['arr_pc_payment'];


foreach ($list_data as $k => $v) {
    $get_tf_amount = isset($v['get_tf_amount']) ? $v['get_tf_amount'] : '';
    $get_tf_currency = isset($v['get_tf_currency']) ? $v['get_tf_currency'] : '';
    $inp_receipt = isset($v['inp_receipt']) ? $v['inp_receipt'] : '';
    $doc_number = isset($v['doc_number']) ? $v['doc_number'] : '';


$sql_insert_detail = "
    INSERT INTO `transac_recript_petty_cash`(
        `tranfer_by`,
        `doc_number`,
        `amount`,
        `currency`,
        `paid_date_time`
    )
    VALUES(
        '$data_user',
        '$doc_number',
        '$get_tf_amount',
        '$get_tf_currency',
        '$t_time_save'
    )
";



$status = $con->query($sql_insert_detail);
}


echo json_encode($status);

 //$status = $con->query($sql_add_list);
 //print_r($status);
