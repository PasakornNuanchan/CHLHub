<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';

$uset_arr_temp = $_POST['uset_arr_temp'];
$arr_data = $_POST['arr_data'] ? $_POST['arr_data'] : ''; 
$data_del = $_POST['data_del'] ? $_POST['data_del'] : '';

// print_r($uset_arr_temp);
// print_r($arr_data);
$carrier_id = isset($_POST['uset_arr_temp']['carrier_id']) ? $_POST['uset_arr_temp']['carrier_id'] : '';
$corp_name = isset($_POST['uset_arr_temp']['corp_name']) ? $_POST['uset_arr_temp']['corp_name'] : '';
$corp_sub_name = isset($_POST['uset_arr_temp']['corp_sub_name']) ? $_POST['uset_arr_temp']['corp_sub_name'] : '';
$corp_em = isset($_POST['uset_arr_temp']['corp_em']) ? $_POST['uset_arr_temp']['corp_em'] : '';
$phone_number = isset($_POST['uset_arr_temp']['phone_number']) ? $_POST['uset_arr_temp']['phone_number'] : '';
$contact = isset($_POST['uset_arr_temp']['contact']) ? $_POST['uset_arr_temp']['contact'] : '';
$payment_term = isset($_POST['uset_arr_temp']['payment_term']) ? $_POST['uset_arr_temp']['payment_term'] : '';

$data_type = "";
$last_id = "";
if ($carrier_id != '') {
    $sql_save = "
                UPDATE
                    `carrier`
                SET
                    `carrier_name` = '$corp_name',
                    `carrier_sub_name` = '$corp_sub_name',
                    `email` = '$corp_em',
                    `phone_number` = '$phone_number',
                    `contact_name` = '$contact',
                    `payment_term` = '$payment_term'
                WHERE
                    `ID` = '$carrier_id'
                    ";
    $data_type = '1';
} else {
    $sql_save = "
                INSERT INTO `carrier`(
                    `carrier_name`,
                    `carrier_sub_name`,
                    `email`,
                    `phone_number`,
                    `contact_name`,
                    `payment_term`
                )
                VALUES(
                    '$corp_name',
                    '$corp_sub_name',
                    '$corp_em',
                    '$phone_number',
                    '$contact',
                    '$payment_term'
                )
                            ";
    $data_type = '2';
}

if ($con->query($sql_save) != 1) {
    $arr_suc['st'] = '0';
} else {
    $arr_suc['st'] = '1';
    $last_id_insert = $con->insert_id;
    $last_id_update = $carrier_id;
    if ($data_type == '1') {
        $last_id = $last_id_update;
    } else {
        $last_id = $last_id_insert;
    }
}
$arr_bank['st'] = '0';

if($arr_data != ''){
    foreach($arr_data as $k => $v){
        $id_number = isset($v['id_number']) ? $v['id_number'] : '';
        $bank_abb = isset($v['bank_abb']) ? $v['bank_abb'] : '';
        $company_name = isset($v['company_name']) ? $v['company_name'] : '';
        $company_address = isset($v['company_address']) ? $v['company_address'] : '';
        $bank_name = isset($v['bank_name']) ? $v['bank_name'] : '';
        $bank_account = isset($v['bank_account']) ? $v['bank_account'] : '';
        $bank_swift_code = isset($v['bank_swift_code']) ? $v['bank_swift_code'] : '';
        $bank_code = isset($v['bank_code']) ? $v['bank_code'] : '';
        $country = isset($v['country']) ? $v['country'] : '';
        $tax_number = isset($v['tax_number']) ? $v['tax_number'] : '';
        $commercial_number = isset($v['commercial_number']) ? $v['commercial_number'] : '';
    
        if($id_number == ''){
            $sql_save_bank = "
        INSERT INTO `carrier_bank`(
            `bank_abb`,
            `company_name`,
            `company_address`,
            `bank_number`,
            `bank_account`,
            `bank_swift_code`,
            `bank_code`,
            `country`,
            `tax_number`,
            `commercial_number`,
            `carrier_id`
        )
        VALUES(
            '$bank_abb',
            '$company_name',
            '$company_address',
            '$bank_name',
            '$bank_account',
            '$bank_swift_code',
            '$bank_code',
            '$country',
            '$tax_number',
            '$commercial_number',
            '$last_id'
        )
        ";
        }else{
            $sql_save_bank = "
            UPDATE
                `carrier_bank`
            SET
                `bank_abb` = '$bank_abb',
                `company_name` = '$company_name',
                `company_address` = '$company_address',
                `bank_number` = '$bank_name',
                `bank_account` = '$bank_account',
                `bank_swift_code` = '$bank_swift_code',
                `bank_code` = '$bank_code',
                `country` = '$country',
                `tax_number` = '$tax_number',
                `commercial_number` = '$commercial_number'
            WHERE
                ID = '$id_number'
            ";
        }
        if ($con->query($sql_save_bank) != 1) {
            $arr_bank['st'] = '0';
        } else {
            $arr_bank['st'] = '1';
        }
    }
}

if($data_del != ''){
    foreach($data_del as $k => $v){
        $id_number = $v;
        $sql_delete = "
        DELETE FROM `carrier_bank` WHERE ID = '$id_number'
        ";

        if ($con->query($sql_delete) != 1) {
            $arr_del['st'] = '0';
        } else {
            $arr_del['st'] = '1';
        }
    }
}

echo json_encode(array('arr_suc' => $arr_suc, 'last_id' => $last_id ,'arr_bank'=>$arr_bank));
   
