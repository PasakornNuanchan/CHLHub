<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
include '../../core/con_path.php';

$arr_billing = $_POST['arr_save'];

foreach($arr_billing as $k => $v){
$id_number = isset($v['id_number']) ? $v['id_number'] : '';
$get_id = isset($v['get_id']) ? $v['get_id'] : '';
$get_type = isset($v['get_type']) ? $v['get_type'] : '';
$get_data_description = isset($v['get_data_description']) ? $v['get_data_description'] : '';
$get_data_bill_to = isset($v['get_data_bill_to']) ? $v['get_data_bill_to'] : '';
$get_data_bill_to_type = isset($v['get_data_bill_to_type']) ? $v['get_data_bill_to_type'] : '';
$get_currency = isset($v['get_currency']) ? $v['get_currency'] : '';
$get_qty = isset($v['get_qty']) ? $v['get_qty'] : '';
$get_unit_price = isset($v['get_unit_price']) ? $v['get_unit_price'] : '';
$get_vat = isset($v['get_vat']) ? $v['get_vat'] : '';
$get_sys_rate = isset($v['get_sys_rate']) ? $v['get_sys_rate'] : '';
$get_data_apply = $v['get_data_apply'];
$get_remark = isset($v['get_remark']) ? $v['get_remark'] : '';
$get_check = $v['get_check'];
$get_with_hold = $v['get_with_hold'];
$get_commit = $v['get_commit'];
$currency_main_ap = isset($v['currency_main_ap']) ? $v['currency_main_ap'] : '';
$get_commit = $get_commit === '' ? "NULL" : $get_commit;

$get_data_apply_attr = isset($v['get_data_apply_attr']) ? $v['get_data_apply_attr'] : '';
$get_check_attr = isset($v['get_check_attr']) ? $v['get_check_attr'] : '';
$get_with_hold_attr = isset($v['get_with_hold_attr']) ? $v['get_with_hold_attr'] : '';
$need_vat = isset($v['get_need_vat']) ? $v['get_need_vat'] : '';
$revd_amt = isset($v['get_revd_amt']) ? $v['get_revd_amt'] : '';
// case update
if($get_data_apply_attr == '1'){
    $data_create_date ='';
}else{
    if($get_data_apply == '1' || $revd_amt == '1'){
        $data_create_date = "
        `action_paid_date_time` = '$t_time_save',
        `action_paid_by` = '$data_user',
        ";
    }else{
        $data_create_date = "
        `action_paid_date_time` = NULL,
        `action_paid_by` = NULL,
        ";
    }
}

if($get_check_attr == '1'){
    $data_check_date ='';
}else{
    if($get_check == '1'){
        $data_check_date = "
        `check_date_time` = '$t_time_save',
        `check_by` = '$data_user',
        ";
    }else{
        $data_check_date = "
        `check_date_time` = NULL,
        `check_by` = NULL,
        ";
    }
}

if($get_with_hold_attr == '1'){
    $data_with_hold_date ='';
}else{
    if($get_with_hold == '1'){
        $data_with_hold_date = "
        `tax_with_hold_date_time` = '$t_time_save',
        `tax_with_hold_by` = '$data_user',
        ";
    }else{
        $data_with_hold_date = "
        `tax_with_hold_date_time` = NULL,
        `tax_with_hold_by` = NULL,
        ";
    }
}

// insert case
if($get_data_apply == 1){
    $apply_by = "'".$data_user."'";
    $apply_date_time = "'".$t_time_save."'";
}else if($revd_amt == 1){
    $apply_by = "'".$data_user."'";
    $apply_date_time = "'".$t_time_save."'";
}else{
    $apply_by = "NULL";
    $apply_date_time = "NULL";
}

if($get_check == 1){
    $check_by = "'".$data_user."'";
    $check_date_time = "'".$t_time_save."'";
}else{
    $check_by = "NULL";
    $check_date_time = "NULL";
}

if($get_with_hold == 1){
    $tax_with_hold_by = "'".$data_user."'";
    $tax_with_hold_time = "'".$t_time_save."'";
}else{
    $tax_with_hold_by = "NULL";
    $tax_with_hold_time = "NULL";
}
    


    if($get_id != ''){
        if($get_type == "AR"){
            $sql_query_data = "
            UPDATE
                `billing`
            SET
                `billing_description` = '$get_data_description',
                `bill_to_type` = '$get_data_bill_to_type',
                `bill_to` = '$get_data_bill_to',
                `currency` = '$get_currency',
                `qty` = '$get_qty',
                `unit_price` = '$get_unit_price',
                `vat` = '$get_vat',
                `remark` = '$get_remark',
                $data_create_date
                $data_check_date
                `last_update_by` = '$data_user',
                `last_update_datetime` = '$t_time_save',
                `sys_rate` = '$get_sys_rate',
                `currency_main` = '$currency_main_ap'
            WHERE
                `ID` = '$get_id'
            ";
        }else if($get_type == "AP"){
            $sql_query_data = "
            UPDATE
                `billing`
            SET
                `billing_description` = '$get_data_description',
                `bill_to_type` = '$get_data_bill_to_type',
                `bill_to` = '$get_data_bill_to',
                `currency` = '$get_currency',
                `qty` = '$get_qty',
                `unit_price` = '$get_unit_price',
                `vat` = '$get_vat',
                `remark` = '$get_remark',
                $data_create_date
                $data_check_date
                `last_update_by` = '$data_user',
                `last_update_datetime` = '$t_time_save',
                `sys_rate` = '$get_sys_rate',
                `currency_main` = '$currency_main_ap'
            WHERE
                `ID` = '$get_id'
            ";
        }
        
    }else{
        if($get_type == "AR"){

            $sql_query_data = "
            INSERT INTO `billing`(
                `billing_description`,
                `bill_to_type`,
                `bill_to`,
                `currency`,
                `qty`,
                `unit_price`,
                `vat`,
                `remark`,
                `type`,
                `create_data_time`,
                `create_by`,
                `action_paid_by`,
                `action_paid_date_time`,
                `check_by`,
                `check_date_time`,
                `ref_job_id`,
                `last_update_by`,
                `last_update_datetime`,
                `sys_rate`,
                `currency_main`,
                `need_vat`
            )
            VALUES(
                '$get_data_description',
                '$get_data_bill_to_type',
                '$get_data_bill_to',
                '$get_currency',
                '$get_qty',
                '$get_unit_price',
                '$get_vat',
                '$get_remark',
                '$get_type',
                '$t_time_save',
                '$data_user',
                $apply_by,
                $apply_date_time,
                $check_by,
                $check_date_time,
                '$id_number',
                '$data_user',
                '$t_time_save',
                '$get_sys_rate',
                '$currency_main_ap',
                '$need_vat'
                

            )
            ";
        }else if($get_type == "AP"){
          $sql_query_data = "
            INSERT INTO `billing`(
                `billing_description`,
                `bill_to_type`,
                `bill_to`,
                `currency`,
                `qty`,
                `unit_price`,
                `vat`,
                `remark`,
                `type`,
                `create_data_time`,
                `create_by`,
                `action_paid_by`,
                `action_paid_date_time`,
                `check_by`,
                `check_date_time`,
                `ref_job_id`,
                `last_update_by`,
                `last_update_datetime`,
                `sys_rate`,
                `tax_with_hold_by`,
                `commit_sale`,
                `tax_with_hold_date_time`,
                `currency_main`
            )
            VALUES(
                '$get_data_description',
                '$get_data_bill_to_type',
                '$get_data_bill_to',
                '$get_currency',
                '$get_qty',
                '$get_unit_price',
                '$get_vat',
                '$get_remark',
                '$get_type',
                '$t_time_save',
                '$data_user',
                $apply_by,
                $apply_date_time,
                $check_by,
                $check_date_time,
                '$id_number',
                '$data_user',
                '$t_time_save',
                '$get_sys_rate',
                $tax_with_hold_by,
                $get_commit,
                $tax_with_hold_time,
                '$currency_main_ap'
            )
            ";
        }
    }
 //echo $sql_query_data;
$result = $con->query($sql_query_data);
if ($result->num_rows == 0) {
    $arr_res = '1';
} else {
    $arr_res = '0';
}


echo json_encode(array('arr_res'=>$arr_res));
}
