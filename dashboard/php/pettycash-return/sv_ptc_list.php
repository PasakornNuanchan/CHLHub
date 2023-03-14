<?php
session_start();
include '../../core/conn.php';
require '../../function/auth/get_session.php';
include '../../core/con_path.php';
$list_data = $_POST['arr_sv_ptc'];
$val_id = $_POST['arr_sv_ptc']['val_id'];




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

    

    $sql = "SELECT ID FROM `petty_cash_title` WHERE petty_cash_number = '$petty_cash_number'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $sql_id = $row['ID'];
        }
    } else {
        $sql_id = "0 results";
    }

    $sql_update = "
    UPDATE
        `cash_payment`
    SET
        `status` = '2'
    WHERE
        ID_petty_cash = '$sql_id' AND status <> '1' ";

    if ($con->query($sql_update) != 1) {
        $arr_suc['up'] = '0';
    } else {
        $arr_suc['up'] = '1';
    }

    if ($con->query($sql_insert_detail) != 1) {
        $arr_suc['st'] = '0';
    } else {
        $arr_suc['st'] = '1';
    }
}


echo json_encode($arr_suc['st'],$arr_suc['up']);

 //$status = $con->query($sql_add_list);
 //print_r($status);
