<?php
include '../../core/conn.php';

$uset_arr_temp = $_POST['uset_arr_temp'];
$arr_data = $_POST['arr_data'];
$del_list = $_POST['del_list'];
$shipper_id = isset($_POST['uset_arr_temp']['shipper_id']) ? $_POST['uset_arr_temp']['shipper_id'] : '';
$cname = isset($_POST['uset_arr_temp']['cname']) ? $_POST['uset_arr_temp']['cname'] : '';
$address = isset($_POST['uset_arr_temp']['address']) ? $_POST['uset_arr_temp']['address'] : '';
$tax = isset($_POST['uset_arr_temp']['tax']) ? $_POST['uset_arr_temp']['tax'] : '';
$email = isset($_POST['uset_arr_temp']['email']) ? $_POST['uset_arr_temp']['email'] : '';
$phone_number = isset($_POST['uset_arr_temp']['phone_number']) ? $_POST['uset_arr_temp']['phone_number'] : '';
$fax = isset($_POST['uset_arr_temp']['fax']) ? $_POST['uset_arr_temp']['fax'] : '';
$linkman = isset($_POST['uset_arr_temp']['linkman']) ? $_POST['uset_arr_temp']['linkman'] : '';
$linkman_tel = isset($_POST['uset_arr_temp']['linkman_tel']) ? $_POST['uset_arr_temp']['linkman_tel'] : '';
$payment_term = isset($_POST['uset_arr_temp']['payment_term']) ? $_POST['uset_arr_temp']['payment_term'] : '';


if ($shipper_id != 'undefined') {
    $sql_save = "
        UPDATE
            `shipper`
        SET
            `tel` = '$phone_number',
            `fax` = '$fax',
            `linkman` = '$linkman',
            `email` = '$email',
            `address` = '$address',
            `tax` = '$tax',
            `linkman_tel` = '$linkman_tel',
            `payment_term` = '$payment_term'
        WHERE
            `ID` = '$shipper_id'
                        ";
    if ($con->query($sql_save) != 1) {
        $arr_suc['st'] = '0';
    } else {
        $arr_suc['st'] = '1';
        $last_id_insert = $shipper_id;
    }
} else {

    $sql_save = "
        INSERT INTO `shipper`(
            `shipper_name`,
            `tel`,
            `fax`,
            `linkman`,
            `email`,
            `address`,
            `tax`,
            `linkman_tel`,
            `payment_term`
                )
        VALUES(
            '$cname',
            '$phone_number',
            '$fax',
            '$linkman',
            '$email',
            '$address',
            '$tax',
            '$linkman_tel',
            '$payment_term'
        )";
        if ($con->query($sql_save) != 1) {
            $arr_suc['st'] = '0';
        } else {
            $arr_suc['st'] = '1';
            $last_id_insert = $con->insert_id;
        }
}

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

        if($id_number != ''){
            $sql_data_bank = "
            UPDATE
                `shipper_bank`
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
        }else{
            $sql_data_bank = "
            INSERT INTO `shipper_bank`(
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
                `shipper_id`
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
                '$last_id_insert'
            )
            ";
        }
        if ($con->query($sql_data_bank) != 1) {
            $arr_suc_bank['st'] = '0';
        } else {
            $arr_suc_bank['st'] = '1';
        }
    }
}

if($del_list != ''){
    foreach($del_list as $k => $v){
        $id_number = $v;
        $sql_del = "
        DELETE
        FROM
            `shipper_bank`
        WHERE
            ID = '$id_number'
        ";
        if ($con->query($sql_del) != 1) {
            $arr_suc_del['st'] = '0';
        } else {
            $arr_suc_del['st'] = '1';
        }
    }
}


echo json_encode(array('arr_suc'=>$arr_suc,'last_id'=>$last_id_insert));
