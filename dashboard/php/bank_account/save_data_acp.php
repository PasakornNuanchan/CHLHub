<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';

$arr_data = $_POST['arr_data'];

foreach($arr_data as $k => $v){

    $id_number = isset($v['id_number']) ? $v['id_number'] : '';
    $country_code = isset($v['country_code']) ? $v['country_code'] : '';
    $country = isset($v['country']) ? $v['country'] : '';
    $payment_method = isset($v['payment_method']) ? $v['payment_method'] : '';
    $bank_code = isset($v['bank_code']) ? $v['bank_code'] : '';
    $company = isset($v['company']) ? $v['company'] : '';
    $bank_account = isset($v['bank_account']) ? $v['bank_account'] : '';
    $currency = isset($v['currency']) ? $v['currency'] : '';
    $bank_brunch = isset($v['bank_brunch']) ? $v['bank_brunch'] : '';
    $bank_address = isset($v['bank_address']) ? $v['bank_address'] : '';
    $swift_code = isset($v['swift_code']) ? $v['swift_code'] : '';
    $bank_telephone = isset($v['bank_telephone']) ? $v['bank_telephone'] : '';
    $commercial_number = isset($v['commercial_number']) ? $v['commercial_number'] : '';
    $tax_number = isset($v['tax_number']) ? $v['tax_number'] : '';

    if($id_number != ''){
        $sql_query_data = "
        UPDATE
            `acbank`
        SET
            `location` = '$country_code',
            `country` = '$country',
            `payment_menthod` = '$payment_method',
            `bank_code` = '$bank_code',
            `company_name` = '$company',
            `bank_account` = '$bank_account',
            `currency` = '$currency',
            `bank_brunch` = '$bank_brunch',
            `bank_address` = '$bank_address',
            `swift_code` = '$swift_code',
            `bank_telephone` = '$bank_telephone',
            `commercial_number` = '$commercial_number',
            `tax_number` = '$tax_number',
            `last_modify_by` = '$data_user',
            `last_modify_datetime` = '$t_time_save'
        WHERE
            ID = '$id_number'
        ";
    }else{
        $sql_query_data = "
        INSERT INTO `acbank`(
            `location`,
            `country`,
            `payment_menthod`,
            `bank_code`,
            `company_name`,
            `bank_account`,
            `currency`,
            `bank_brunch`,
            `bank_address`,
            `swift_code`,
            `bank_telephone`,
            `commercial_number`,
            `tax_number`,
            `create_by`,
            `create_datetime`
        )
        VALUES(
            '$country_code',
            '$country',
            '$payment_method',
            '$bank_code',
            '$company',
            '$bank_account',
            '$currency',
            '$bank_brunch',
            '$bank_address',
            '$swift_code',
            '$bank_telephone',
            '$commercial_number',
            '$tax_number',
            '$data_user',
            '$t_time_save'
        )
        ";
    }
    $result = $con->query($sql_query_data);
    if ($result->num_rows == 0) {
        $arr_res = '1';
    } else {
        $arr_res = '0';
    }

}
echo json_encode(array('arr_res'=>$arr_res))
?>