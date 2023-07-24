<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
include '../../core/con_path.php';

$arr_billing = $_POST['arr_save'];

foreach($arr_billing as $k => $v){
    $id_number = isset($v['id_number']) ? $v['id_number'] : '';
    $get_id_data = isset($v['get_id']) ? $v['get_id'] : '';
    $get_type = isset($v['get_type']) ? $v['get_type'] : '';
    $get_description = isset($v['get_description']) ? $v['get_description'] : '';
    $inp_billing_to = isset($v['inp_billing_to']) ? $v['inp_billing_to'] : 'a';
    $inp_add_on = isset($v['inp_add_on']) ? $v['inp_add_on'] : '' ;
    $inp_currency = isset($v['inp_currency']) ? $v['inp_currency'] : '';
    $inp_qty = isset($v['inp_qty']) ? $v['inp_qty'] : '';
    $inp_unit_price = isset($v['inp_unit_price']) ? $v['inp_unit_price'] : '';
    $inp_amt = isset($v['inp_amt']) ? $v['inp_amt'] : '';
    $inp_vat = isset($v['inp_vat']) ? $v['inp_vat'] : '';
    $inp_amtincv = isset($v['inp_amtincv']) ? $v['inp_amtincv'] : '';
    $inp_remark = isset($v['inp_remark']) ? $v['inp_remark'] : '';
    
    if($get_id_data != ''){
        if($get_type == "AR"){
            $sql_query_data = "
            UPDATE
                `billing`
            SET
                `billing_description` = '$get_description',
                `bill_to` = '$inp_billing_to',
                `currency` = '$inp_currency',
                `qty` = '$inp_qty',
                `unit_price` = '$inp_unit_price',
                `amount` = '$inp_amt',
                `vat` = '$inp_vat',
                `amtinclvat` = '$inp_amtincv',
                `remark` = '$inp_remark',
                `type` = '$get_type',
                `status` = '0',
                `ref_job_id` = '$id_number',
                `add_on` = '$inp_add_on',
                `last_update_by` = '$data_user',
                `last_update_datetime` = '$t_time_save'
            WHERE
                ID = '$get_id_data'
            ";
        }else if($get_type == "AP"){
            $sql_query_data = "
            UPDATE
                `billing`
            SET
                `billing_description` = '$get_description',
                `bill_to` = '$inp_billing_to',
                `currency` = '$inp_currency',
                `qty` = '$inp_qty',
                `unit_price` = '$inp_unit_price',
                `amount` = '$inp_amt',
                `vat` = '$inp_vat',
                `amtinclvat` = '$inp_amtincv',
                `remark` = '$inp_remark',
                `type` = '$get_type',
                `status` = '0',
                `ref_job_id` = '$id_number',
                `last_update_by` = '$data_user',
                `last_update_datetime` = '$t_time_save'
            WHERE
                ID = '$get_id_data'
            ";
        }
        
    }else{
        if($get_type == "AR"){
            $sql_query_data = "
            INSERT INTO `billing`(
                `billing_description`,
                `bill_to`,
                `currency`,
                `qty`,
                `unit_price`,
                `amount`,
                `vat`,
                `amtinclvat`,
                `remark`,
                `type`,
                `create_data_time`,
                `create_by`,
                `status`,
                `ref_job_id`,
                `add_on`,
                `last_update_by`,
                `last_update_datetime`
            )
            VALUES(
                '$get_description',
                '$inp_billing_to',
                '$inp_currency',
                '$inp_qty',
                '$inp_unit_price',
                '$inp_amt',
                '$inp_vat',
                '$inp_amtincv',
                '$inp_remark',
                '$get_type',
                '$t_time_save',
                '$data_user',
                '0',
                '$id_number',
                '$inp_add_on',
                '$data_user',
                '$t_time_save'
            )
            ";
        }else if($get_type == "AP"){
            $sql_query_data = "
            INSERT INTO `billing`(
                `billing_description`,
                `bill_to`,
                `currency`,
                `qty`,
                `unit_price`,
                `amount`,
                `vat`,
                `amtinclvat`,
                `remark`,
                `type`,
                `create_data_time`,
                `create_by`,
                `status`,
                `ref_job_id`,
                `last_update_by`,
                `last_update_datetime`
            )
            VALUES(
                '$get_description',
                '$inp_billing_to',
                '$inp_currency',
                '$inp_qty',
                '$inp_unit_price',
                '$inp_amt',
                '$inp_vat',
                '$inp_amtincv',
                '$inp_remark',
                '$get_type',
                '$t_time_save',
                '$data_user',
                '0',
                '$id_number',
                '$data_user',
                '$t_time_save'
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



?>