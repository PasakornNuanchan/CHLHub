<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';

$arr_data_save_ap = $_POST['arr_data_save_ap'];
$arr_data_save_ar = $_POST['arr_data_save_ar'];

foreach ($arr_data_save_ap as $v) {

    $get_id_list = isset($v['get_id_list']) ? $v['get_id_list'] : '';
    $description_code = isset($v['description_code']) ? $v['description_code'] : '';
    $billing_to_type = isset($v['billing_to_type']) ? $v['billing_to_type'] : '';
    $billing_to = isset($v['billing_to']) ? $v['billing_to'] : '';
    $currency = isset($v['currency']) ? $v['currency'] : '';
    $qty = isset($v['qty']) ? $v['qty'] : '0';
    $unit_price = isset($v['unit_price']) ? $v['unit_price'] : '0';
    $vat = isset($v['vat']) ? $v['vat'] : '0';
    $sys_rate = isset($v['sys_rate']) ? $v['sys_rate'] : '';
    $sys_rate_currency = isset($v['sys_rate_currency']) ? $v['sys_rate_currency'] : '';
    $remark = isset($v['remark']) ? $v['remark'] : '';
    $commit_sale = isset($v['commit_sale']) ? $v['commit_sale'] : '';
    $tax_with_hold = isset($v['tax_with_hold']) ? $v['tax_with_hold'] : '';
    $check = isset($v['check']) ? $v['check'] : '';
    $apply = isset($v['apply']) ? $v['apply'] : '';
    $id_number = isset($v['id_number']) ? $v['id_number'] : '';


    $receiv_amt = isset($v['receiv_amt']) ? $v['receiv_amt'] : '';
    $need_vat = isset($v['need_vat']) ? $v['need_vat'] : '';

    $qty = $qty != '' ? $qty : 0;
    $unit_price = $unit_price != '' ? $unit_price : 0;
    $vat = $vat != '' ? $vat : 0;
    $sys_rate = $sys_rate != '' ? $sys_rate : 0;
    $commit_sale = $commit_sale != '' ? $commit_sale : 0;

    
    if ($get_id_list != '') {
        $query_apply = "";
        $query_status = "`status` = '0',`";
        if ($apply != '') {
            $query_apply = "
            `action_paid_by` = '$data_user',
            `action_paid_date_time` = '$t_time_save',
            ";
            $query_status = "`status` = '1',";

        }

        $query_check = "";
        if ($check != '') {
            $query_check = "
            `check_by` = '$data_user',
            `check_date_time` = '$t_time_save',
            ";
        }

        // update
        $sql_query_data_billing_ap = "
        UPDATE
            `billing`
        SET
            `billing_description` = '$description_code',
            `bill_to_type` = '$billing_to_type',
            `bill_to` = '$billing_to',
            `currency` = '$currency',
            `qty` = '$qty',
            `unit_price` = '$unit_price',
            `vat` = '$vat',
            `remark` = '$remark',
            `type` = 'AP',
            $query_apply
            $query_check
            $query_status
            `last_update_by` = '$data_user',
            `last_update_datetime` = '$t_time_save',
            `sys_rate` = '$sys_rate',
            `sys_rate_currency` = '$sys_rate_currency',
            `commit_sale` = '$commit_sale',
            `with_holding_tax` = '$tax_with_hold'
        WHERE
            ID = '$get_id_list'
        ";
    } else {
        $query_check_h_b = "";
        $query_check_h_d = "";
        $query_check_d_b = "";
        $query_check_d_d = "";

        if ($check == '1') {
            $query_check_h_b = "`check_by`,";
            $query_check_h_d = "`check_date_time`,";
            $query_check_d_b = "'" . $data_user . "',";
            $query_check_d_d = "'" . $t_time_save . "',";
        }

        $query_apply_h_d = "";
        $query_apply_h_b = "";
        $query_apply_d_b = "";
        $query_apply_d_d = "";
        $query_status = "'"."0"."',";
        if ($apply == '1') {
            $query_apply_h_b = "`action_paid_by`,";
            $query_apply_h_d = "`action_paid_date_time`,";
            $query_apply_d_b = "'" . $data_user . "',";
            $query_apply_d_d = "'" . $t_time_save . "',";
            $query_status = "'"."1"."',";
        }


        //insert
        $sql_query_data_billing_ap = "
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
            $query_check_h_b
            $query_check_h_d
            $query_apply_h_d
            $query_apply_h_b
            `status`,
            `ref_job_id`,
            `sys_rate`,
            `Billing_date`,
            `sys_rate_currency`,
            `commit_sale`,
            `with_holding_tax`
        )
        VALUES(
            '$description_code',
            '$billing_to_type',
            '$billing_to',
            '$currency',
            '$qty',
            '$unit_price',
            '$vat',
            '$remark',
            'AP',
            '$t_time_save',
            '$data_user',
            $query_check_d_b
            $query_check_d_d
            $query_apply_d_b
            $query_apply_d_d
            $query_status
            '$id_number',
            '$sys_rate',
            '$t_time_save',
            '$sys_rate_currency',
            '$commit_sale',
            '$with_holding_tax'
        )
        ";
    }

    $result = $con->query($sql_query_data_billing_ap);
    if ($result->num_rows == 0) {
        $arr_res_ap = '1';
    } else {
        $arr_res_ap = '0';
    }
}

foreach ($arr_data_save_ar as $v) {

    $get_id_list = isset($v['get_id_list']) ? $v['get_id_list'] : '';
    $description_code = isset($v['description_code']) ? $v['description_code'] : '';
    $billing_to_type = isset($v['billing_to_type']) ? $v['billing_to_type'] : '';
    $billing_to = isset($v['billing_to']) ? $v['billing_to'] : '';
    $currency = isset($v['currency']) ? $v['currency'] : '';
    $qty = isset($v['qty']) ? $v['qty'] : '0';
    $unit_price = isset($v['unit_price']) ? $v['unit_price'] : '0';
    $vat = isset($v['vat']) ? $v['vat'] : '0';
    $sys_rate = isset($v['sys_rate']) ? $v['sys_rate'] : '';
    $sys_rate_currency = isset($v['sys_rate_currency']) ? $v['sys_rate_currency'] : '';
    $remark = isset($v['remark']) ? $v['remark'] : '';
    $tax_with_hold = isset($v['tax_with_hold']) ? $v['tax_with_hold'] : '';
    $check = isset($v['check']) ? $v['check'] : '';
    $id_number = isset($v['id_number']) ? $v['id_number'] : '';


    $receiv_amt = isset($v['receiv_amt']) ? $v['receiv_amt'] : '';
    $need_vat = isset($v['need_vat']) ? $v['need_vat'] : '';

    $qty = $qty != '' ? $qty : 0;
    $unit_price = $unit_price != '' ? $unit_price : 0;
    $vat = $vat != '' ? $vat : 0;
    $sys_rate = $sys_rate != '' ? $sys_rate : 0;

    
    if ($get_id_list != '') {
        $query_receiv = "";
        $query_status = "`status` = '0',`";

        if ($receiv_amt != '') {
            $query_receiv = "
            `action_paid_by` = '$data_user',
            `action_paid_date_time` = '$t_time_save',
            ";
            $query_status = "`status` = '1',`";

        }

        $query_check = "";
        if ($check != '') {
            $query_check = "
            `check_by` = '$data_user',
            `check_date_time` = '$t_time_save',
            ";
        }

        $query_need_vat = "";
        if($need_vat != ''){
            $query_need_vat = "
            `need_vat` = '$need_vat',
            ";
        }

        // update
        $sql_query_data_billing_ar = "
        UPDATE
            `billing`
        SET
            `billing_description` = '$description_code',
            `bill_to_type` = '$billing_to_type',
            `bill_to` = '$billing_to',
            `currency` = '$currency',
            `qty` = '$qty',
            `unit_price` = '$unit_price',
            `vat` = '$vat',
            `remark` = '$remark',
            `type` = 'AP',
            $query_receiv
            $query_check
            $query_status
            `last_update_by` = '$data_user',
            `last_update_datetime` = '$t_time_save',
            $query_need_vat
            `sys_rate` = '$sys_rate',
            `sys_rate_currency` = '$sys_rate_currency',
            `with_holding_tax` = '$tax_with_hold'
        WHERE
            ID = '$get_id_list'
        ";
    } else {
        $query_check_h_b = "";
        $query_check_h_d = "";
        $query_check_d_b = "";
        $query_check_d_d = "";

        if ($check == '1') {
            $query_check_h_b = "`check_by`,";
            $query_check_h_d = "`check_date_time`,";
            $query_check_d_b = "'" . $data_user . "',";
            $query_check_d_d = "'" . $t_time_save . "',";
        }
        $query_status = "'"."0"."',";
        $query_apply_h_d = "";
        $query_apply_h_b = "";
        $query_apply_d_b = "";
        $query_apply_d_d = "";
        if ($receiv_amt == '1') {
            $query_apply_h_b = "`action_paid_by`,";
            $query_apply_h_d = "`action_paid_date_time`,";
            $query_apply_d_b = "'" . $data_user . "',";
            $query_apply_d_d = "'" . $t_time_save . "',";
            $query_status = "'"."1"."',";

        }

        $query_need_vat_h = "";
        $query_need_vat_d = "";

        if($query_need_vat == '1'){
        
            $query_need_vat_h =  "`need_vat`,";
            $query_need_vat_d =  "'".$need_vat."'";
        }


        //insert
        $sql_query_data_billing_ar = "
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
            $query_check_h_b
            $query_check_h_d
            $query_apply_h_d
            $query_apply_h_b
            $query_need_vat_h
            `status`,
            `ref_job_id`,
            `sys_rate`,
            `Billing_date`,
            `sys_rate_currency`,
            `with_holding_tax`
        )
        VALUES(
            '$description_code',
            '$billing_to_type',
            '$billing_to',
            '$currency',
            '$qty',
            '$unit_price',
            '$vat',
            '$remark',
            'AR',
            '$t_time_save',
            '$data_user',
            $query_check_d_b
            $query_check_d_d
            $query_apply_d_b
            $query_apply_d_d
            $query_need_vat_d
            $query_status
            '$id_number',
            '$sys_rate',
            '$t_time_save',
            '$sys_rate_currency',
            '$with_holding_tax'
        )
        ";
    }

    $result = $con->query($sql_query_data_billing_ar);
    if ($result->num_rows == 0) {
        $arr_res_ar = '1';
    } else {
        $arr_res_ar = '0';
    }
}


echo json_encode(array('arr_res_ap'=>$arr_res_ap,'arr_res_ar'=>$arr_res_ar))


?>