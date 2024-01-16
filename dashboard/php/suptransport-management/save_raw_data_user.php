<?php
include '../../core/conn.php';

$uset_arr_temp = $_POST['uset_arr_temp'];

$arr_data_save = $_POST['arr_data_save'];
$del_list = $_POST['del_list'];

$suptransport_id = isset($_POST['uset_arr_temp']['suptransport_id']) ? $_POST['uset_arr_temp']['suptransport_id'] : '';
$cname = isset($_POST['uset_arr_temp']['cname']) ? $_POST['uset_arr_temp']['cname'] : '';
$address = isset($_POST['uset_arr_temp']['address']) ? $_POST['uset_arr_temp']['address'] : '';
$tax = isset($_POST['uset_arr_temp']['tax']) ? $_POST['uset_arr_temp']['tax'] : '';
$email = isset($_POST['uset_arr_temp']['email']) ? $_POST['uset_arr_temp']['email'] : '';
$phone_number = isset($_POST['uset_arr_temp']['phone_number']) ? $_POST['uset_arr_temp']['phone_number'] : '';
$line = isset($_POST['uset_arr_temp']['line']) ? $_POST['uset_arr_temp']['line'] : '';
$fax = isset($_POST['uset_arr_temp']['fax']) ? $_POST['uset_arr_temp']['fax'] : '';
$linkman = isset($_POST['uset_arr_temp']['linkman']) ? $_POST['uset_arr_temp']['linkman'] : '';
$linkman_tel = isset($_POST['uset_arr_temp']['linkman_tel']) ? $_POST['uset_arr_temp']['linkman_tel'] : '';
$payment_term = isset($_POST['uset_arr_temp']['payment_term']) ? $_POST['uset_arr_temp']['payment_term'] : '';


if ($suptransport_id != 'undefined') {
    $sql_save = "
        UPDATE
            `transport_sup`
        SET
            `transport_sup_name` = '$cname',
            `tel` = '$phone_number',
            `fax` = '$fax',
            `linkman` = '$linkman',
            `email` = '$email',
            `line` = '$line',
            `linkman_tel` = '$linkman_tel',
            `address` = '$address',
            `tax` = '$tax',
            `payment_term` = '$payment_term'
        WHERE
            `ID` = '$suptransport_id'
                        ";
    if ($con->query($sql_save) != 1) {
        $arr_suc['st'] = '0';
    } else {
        $arr_suc['st'] = '1';
        $last_id = $suptransport_id;
    }
} else {
    $sql_save = "
        INSERT INTO `transport_sup`(
            `transport_sup_name`,
            `tel`,
            `fax`,
            `linkman`,
            `email`,
            `line`,
            `linkman_tel`,
            `address`,
            `tax`,
            `payment_term`
        )
        VALUES(
            '$cname',
            '$phone_number',
            '$fax',
            '$linkman',
            '$email',
            '$line',
            '$linkman_tel',
            '$address',
            '$tax',
            '$payment_term'
        )
                                ";
    if ($con->query($sql_save) != 1) {
        $arr_suc['st'] = '0';
    } else {
        $arr_suc['st'] = '1';
        $last_id = $con->insert_id;
    }
}


if ($arr_data_save != '') {

    foreach($arr_data_save as $k =>$v){
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
            $sql_bank = "
            UPDATE
                `transport_sub_bank`
            SET
                `bank_abb` = '$bank_abb',
                `company_name` = '$company_name',
                `company_address` = '$company_address',
                `bank_number` = '$bank_name',
                `bank_account` = '$bank_account',
                `bank_swift_code` = '$bank_swift_code',
                `bank_code` = '$bank_code',
                `country` = '$country',
                `tax` = '$tax_number',
                `commercial_number` = '$commercial_number'
            WHERE
                ID = '$id_number'
            ";
        }else{
            $sql_bank = "
            INSERT INTO `transport_sub_bank`(
                `bank_abb`,
                `company_name`,
                `company_address`,
                `bank_number`,
                `bank_account`,
                `bank_swift_code`,
                `bank_code`,
                `country`,
                `tax`,
                `commercial_number`,
                `transport_sup_id`
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
        }

        if ($con->query($sql_bank) != 1) {
            $arr_suc_bank['st'] = '0';
        } else {
            $arr_suc_bank['st'] = '1';
        }
    }

}
if ($del_list != '') {
    foreach ($del_list as $k => $v) {
        $id_list = $v;
        $sql_del = "
        DELETE
        FROM
            `transport_sub_bank`
        WHERE
            ID = '$id_list'
        ";
        if ($con->query($sql_del) != 1) {
            $arr_suc_del['st'] = '0';
        } else {
            $arr_suc_del['st'] = '1';
        }
    }
}


echo json_encode(array('arr_suc' => $arr_suc, 'last_id' => $last_id));
