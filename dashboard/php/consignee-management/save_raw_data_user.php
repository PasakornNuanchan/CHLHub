<?php
include '../../core/conn.php';

$uset_arr_temp = $_POST['uset_arr_temp'];
$arr_data = $_POST['arr_data'];
$del_data = $_POST['del_data'];

$consignee_id = isset($_POST['uset_arr_temp']['consignee_id']) ? $_POST['uset_arr_temp']['consignee_id'] : '';
$corp_name = isset($_POST['uset_arr_temp']['corp_name']) ? $_POST['uset_arr_temp']['corp_name'] : '';
$corp_address = isset($_POST['uset_arr_temp']['corp_address']) ? $_POST['uset_arr_temp']['corp_address'] : '';
$corp_tax_id = isset($_POST['uset_arr_temp']['corp_tax_id']) ? $_POST['uset_arr_temp']['corp_tax_id'] : '';
$corp_email = isset($_POST['uset_arr_temp']['corp_email']) ? $_POST['uset_arr_temp']['corp_email'] : '';
$corp_phone_number = isset($_POST['uset_arr_temp']['corp_phone_number']) ? $_POST['uset_arr_temp']['corp_phone_number'] : '';
$corp_fax = isset($_POST['uset_arr_temp']['corp_fax']) ? $_POST['uset_arr_temp']['corp_fax'] : '';
$corp_linkman = isset($_POST['uset_arr_temp']['corp_linkman']) ? $_POST['uset_arr_temp']['corp_linkman'] : '';
$corp_contact_tel = isset($_POST['uset_arr_temp']['corp_contact_tel']) ? $_POST['uset_arr_temp']['corp_contact_tel'] : '';
$corp_sale_support = isset($_POST['uset_arr_temp']['corp_sale_support']) ? $_POST['uset_arr_temp']['corp_sale_support'] : '';
$corp_term_pay = isset($_POST['uset_arr_temp']['corp_term_pay']) ? $_POST['uset_arr_temp']['corp_term_pay'] : '';


if ($consignee_id != '') {
    $sql_save = "
    UPDATE
        `consignee`
    SET
        `tel` = '$corp_phone_number',
        `email` = '$corp_email',
        `tax` = '$corp_tax_id',
        `address` = '$corp_address',
        `contact_person_name` = '$corp_linkman',
        `contact_person_tel` = '$corp_contact_tel',
        `fax` = '$corp_fax',
        `user_sale` = '$corp_sale_support',
        `payment_term` = '$corp_term_pay'
    WHERE
        `ID` = '$consignee_id'";
        if ($con->query($sql_save) != 1) {
            $arr_suc['st'] = '0';
        } else {
            $arr_suc['st'] = '1';
            $last_id_insert = $consignee_id;
        }
} else {
    $sql_save = "
        INSERT INTO `consignee`(
            `consignee_name`,
            `tel`,
            `email`,
            `tax`,
            `address`,
            `contact_person_name`,
            `contact_person_tel`,
            `fax`,
            `user_sale`,
            `payment_term`
        )
        VALUES(
            '$corp_name',
            '$corp_phone_number',
            '$corp_email',
            '$corp_tax_id',
            '$corp_address',
            '$corp_linkman',
            '$corp_contact_tel',
            '$corp_fax',
            '$corp_sale_support',
            '$corp_term_pay'
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
            $save_data_bank = "
            UPDATE
                `consignee_bank`
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
        }else {
            $save_data_bank = "
            INSERT INTO `consignee_bank`(
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
                `consignee_id`
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
        if ($con->query($save_data_bank) != 1) {
            $arr_suc_bank['st'] = '0';
        } else {
            $arr_suc_bank['st'] = '1';
        }
        
    }
}

if($del_data != ''){
    foreach($del_data as $k => $v){
        $id_number = $v;
        $sql_del = "
        DELETE
        FROM
            `consignee_bank`
        WHERE
            ID = '$id_number'
        ";
    }
    if ($con->query($sql_del) != 1) {
        $arr_suc_del['st'] = '0';
    } else {
        $arr_suc_del['st'] = '1';
    }
}



echo json_encode(array('arr_suc' => $arr_suc, 'last_id' => $last_id_insert));
