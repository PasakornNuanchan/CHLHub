<?php
session_start();
include '../../core/conn.php';
require '../../function/auth/get_session.php';
include '../../core/con_path.php';
$list_data = $_POST['arr_sv_list'];


foreach ($list_data as $k => $v) {
    $sel_mt = isset($v['sel_mt']) ? $v['sel_mt'] : '';
    $inp_payment_amount = isset($v['inp_payment_amount']) ? $v['inp_payment_amount'] : '';
    $sel_payment_currency = isset($v['sel_payment_currency']) ? $v['sel_payment_currency'] : '';
    $inp_file = isset($v['inp_file']) ? $v['inp_file'] : '';
    $advance_number = isset($v['advance_number']) ? $v['advance_number'] : '';
    $ref_cp_id = isset($v['ref_cp_id']) ? $v['ref_cp_id'] : '';
    $ref_id = isset($v['ref_id']) ? $v['ref_id'] : '';

    
    

    $sql_insert_detail = "
    INSERT INTO `transac_return_advance_cash`(
        `payment_by`,
        `payment_amount`,
        `payment_date_time`,
        `payment_re`,
        `doc_number`,
        `payment_currency`,
        `transac_id_payment`,
        `method_payment`,
        `ref_id`
    )
    VALUES(
        '$data_user',
        '$inp_payment_amount',
        '$t_time_save',
        '$inp_file',
        '$advance_number',
        '$sel_payment_currency',
        '$ref_cp_id',
        '$sel_mt',
        '$ref_id'
    )
";

    if ($con->query($sql_insert_detail) != 1) {
        $arr_suc['st'] = '0';
    } else {
        $arr_suc['st'] = '1';
    }
}


echo json_encode($arr_suc['st']);

 //$status = $con->query($sql_add_list);
 //print_r($status);
