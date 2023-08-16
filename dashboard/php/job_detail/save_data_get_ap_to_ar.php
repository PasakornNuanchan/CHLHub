<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
include '../../core/con_path.php';

$arr_save = $_POST['arr_save'];
foreach($arr_save as $k => $v){
    $get_id = isset($v['get_id']) ? $v['get_id'] : '';
    $get_type = isset($v['get_type']) ? $v['get_type'] : '';
    $get_data_description = isset($v['get_data_description']) ? $v['get_data_description'] : '';
    $get_data_bill_to = isset($v['get_data_bill_to']) ? $v['get_data_bill_to'] : '';
    $get_data_bill_to_type = isset($v['get_data_bill_to_type']) ? $v['get_data_bill_to_type'] : '';
    $get_currency = isset($v['get_currency']) ? $v['get_currency'] : '';
    $get_qty = isset($v['get_qty']) ? $v['get_qty'] : '';
    $get_unit_price = isset($v['get_unit_price']) ? $v['get_unit_price'] : '';
    $get_ap_amt = isset($v['get_ap_amt']) ? $v['get_ap_amt'] : '';
    $get_vat = isset($v['get_vat']) ? $v['get_vat'] : '';
    $get_sys_rate = isset($v['get_sys_rate']) ? $v['get_sys_rate'] : '';
    $get_amt_inc_vat = isset($v['get_amt_inc_vat']) ? $v['get_amt_inc_vat'] : '';
    $currency_main_ap = isset($v['currency_main_ap']) ? $v['currency_main_ap'] : '';
    $get_refer = isset($v['get_refer']) ? $v['get_refer'] : '';

    $sql_query_data = "
    INSERT INTO `billing`(
        `billing_description`,
        `bill_to_type`,
        `bill_to`,
        `qty`,
        `unit_price`,
        `amount`,
        `vat`,
        `amtinclvat`,
        `type`,
        `create_data_time`,
        `create_by`,
        `ref_job_id`,
        `sys_rate`,
        `currency_main`,
        `refer`
    )
    VALUES(
        '$get_data_description',
        '$get_data_bill_to_type',
        '$get_data_bill_to',
        '$get_qty',
        '$get_unit_price',
        '$get_ap_amt',
        '$get_vat',
        '$get_amt_inc_vat',
        '$get_type',
        '$t_time_save',
        '$data_user',
        '$get_id',
        '$get_sys_rate',
        '$currency_main_ap',
        '$get_refer'
    )
    ";

    if ($con->query($sql_query_data) === TRUE) {
        $res_status = '1';
    } else {
        $res_status = '0';
    }
    
    
}

echo json_encode(array(
    'res_status'=>$res_status,
));
?>