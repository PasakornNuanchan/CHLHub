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
    $pic = isset($v['pic']) ? $v['pic'] : '';

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

    

    $sql = "SELECT pcd.ID FROM `petty_cash_title` as pct 
    LEFT JOIN petty_cash_detail as pcd ON pct.petty_cash_number = pcd.petty_cash_number
    WHERE pct.petty_cash_number = '$petty_cash_number' AND pcd.currency = '$sel_currency_rt'
    ";

    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $sql_id[] = $row['ID'];
        }
    } else {
        $sql_id = "0 results";
    }
    
    $imp_sql_id = implode(',' , $sql_id);
    $sql_update = "
    UPDATE
        `cash_payment`
    SET
        `status` = '2'
    WHERE
        ID_petty_cash IN ($imp_sql_id) AND status <> '1' ";

    $sql_update_pcd = "
    UPDATE
        `petty_cash_detail`
    SET
        `pcd_status` = '1'
    WHERE
        ID IN ($imp_sql_id)
    ";
    
    if ($con->query($sql_update) != 1) {
        $arr_suc['up'] = '0';
    } else {
        $arr_suc['up'] = '1';
    }

    if ($con->query($sql_update_pcd) != 1) {
        $arr_suc['pcd'] = '0';
    } else {
        $arr_suc['pcd'] = '1';
    }

    if ($con->query($sql_insert_detail) != 1) {
        $arr_suc['st'] = '0';
    } else {
        $arr_suc['st'] = '1';
    }
}


echo json_encode($arr_suc);

 //$status = $con->query($sql_add_list);
 //print_r($status);
