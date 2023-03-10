<?php
session_start();
include '../../core/conn.php';
require '../../function/auth/get_session.php';
include '../../core/con_path.php';
$list_data = $_POST['arr_sv_ptc'];


foreach ($list_data as $k => $v) {
    $sel_mt_return = isset($v['sel_mt_return']) ? $v['sel_mt_return'] : '';
    $inp_payment_val = isset($v['inp_payment_val']) ? $v['inp_payment_val'] : '';
    $sel_currency_rt = isset($v['sel_currency_rt']) ? $v['sel_currency_rt'] : '';
    $inp_rec_by = isset($v['inp_rec_by']) ? $v['inp_rec_by'] : '';
    $petty_cash_number = isset($v['petty_cash_number']) ? $v['petty_cash_number'] : '';
    $val_id = isset($v['val_id']) ? $v['val_id'] : '';


    $sql_insert_detail = "
INSERT INTO `transac_return_petty_cash`(
    `return_by`,
    `return_amount`,
    `return_datetime`,
    `return_re`,
    `doc_number`,
    `return_currency`,
    `transac_id_tranfer`,
    `method_tranfer`
)
VALUES(
    '$data_user',
    '$inp_payment_val',
    '$t_time_save',
    '$inp_rec_by',
    '$petty_cash_number',
    '$sel_currency_rt',
    '$val_id',
    '$sel_mt_return'
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
