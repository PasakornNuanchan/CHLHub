
<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';

$arr_data_get_title = isset($_POST['arr_data_get_title']) ? $_POST['arr_data_get_title'] : '';
$arr_data_get_list = isset($_POST['arr_data_get_list']) ? $_POST['arr_data_get_list'] : '';


foreach($arr_data_get_title as $k => $v){
    $patment_document_number = isset($v['patment_document_number']) ? $v['patment_document_number'] : '';
    $payment_place = isset($v['payment_place']) ? $v['payment_place'] : '';
    $method_payment = isset($v['method_payment']) ? $v['method_payment'] : '';
    $amount_payment = isset($v['amount_payment']) ? $v['amount_payment'] : '';
    $currency = isset($v['currency']) ? $v['currency'] : '';
    $payment_date = isset($v['payment_date']) ? $v['payment_date'] : '';
    $write_off_date = isset($v['write_off_date']) ? $v['write_off_date'] : '';
    $bank_account = isset($v['bank_account']) ? $v['bank_account'] : '';
    $list_description = isset($v['list_description']) ? $v['list_description'] : '';
    $remark_data = isset($v['remark_data']) ? $v['remark_data'] : '';
    $payment_type = isset($v['payment_type']) ? $v['payment_type'] : '';
    $customer_name = isset($v['customer_name']) ? $v['customer_name'] : '';
    $type_data = $v['type_data'] != "" ? "'".$v['type_data']."'" : 'null';
    $name_file = $v['name_file'] != "" ? "'".$v['name_file']."'" : 'null';
    $Base_64_file_base = $v['Base_64_file_base'] != "" ? "'".$v['Base_64_file_base']."'" : 'null';
    $payment_date = $payment_date == '' ? 'null' : "'$payment_date'";
    $write_off_date = $write_off_date == '' ? 'null' : "'$write_off_date'";
    $data_currency_start = isset($v['data_currency_start']) ? $v['data_currency_start'] : '';
    $data_currency_write_off = isset($v['data_currency_write_off']) ? $v['data_currency_write_off'] : '';
    $data_hanler = isset($v['data_hanler']) ? $v['data_hanler'] : '';
    $data_sale = isset($v['data_sale']) ? $v['data_sale'] : '';


    $amount_all_write_off = isset($v['amount_all_write_off']) ? $v['amount_all_write_off'] : '';
    $currency_main_write_off = isset($v['currency_main_write_off']) ? $v['currency_main_write_off'] : '';
    $amount_all = isset($v['amount_all']) ? $v['amount_all'] : '';
    $currency_main = isset($v['currency_main']) ? $v['currency_main'] : '';
    $acual_payment = isset($v['acual_payment']) ? $v['acual_payment'] : '';
    $number_data = isset($v['number_data']) ? $v['number_data'] : '';
    $number_paymenr_rec = isset($v['number_paymenr_rec']) ? $v['number_paymenr_rec'] : '';

    $sql_data_query_title = "
    INSERT INTO `billing_payment`(
        `paid_by`,
        `paid_date_time`,
        `status_billing`,
        `paid_amt`,
        `document_payment`,
        `type_document`,
        `pay_at`,
        `tranfer_method`,
        `total_payment`,
        `bank_account`,
        `payment_date`,
        `write_off_date`,
        `remark`,
        `ref_billing`,
        `consignee_name`,
        `receipt`,
        `type_file_receipt`,
        `file_name`,
        `currency_start`,
        `currency_end`,
        `hanler`,
        `sale`,
        `actual_total_payment`,
        `acount_payment_amount`,
        `number_data`,
        `payment_rec`
    )
    VALUES(
        '$data_user',
        '$t_time_save',
        '1',
        '$amount_all_write_off',
        '$patment_document_number',
        '$payment_type',
        '$payment_place',
        '$method_payment',
        '$amount_payment',
        '$bank_account',
        $payment_date,
        $write_off_date,
        '$remark_data',
        '$list_description',
        '$customer_name',
        $Base_64_file_base,
        $type_data,
        $name_file,
        '$currency_main_write_off',
        '$currency_main',
        '$data_hanler',
        '$data_sale',
        '$amount_all',
        '$acual_payment',
        '$number_data',
        '$number_paymenr_rec'

    )
    ";

    // echo $sql_data_query_title;
    if ($con->query($sql_data_query_title) === TRUE) {
        $last_id = $con->insert_id;
        $res_detail_title = '1';
    } else {
        $res_detail_title = '0';
    }
}

foreach($arr_data_get_list as $k => $v){
    $data_number_id = isset($v['data_number_id']) ? $v['data_number_id'] : '';
    $amount = isset($v['amount']) ? $v['amount'] : '';
    $currency = isset($v['currency']) ? $v['currency'] : '';
    $data_currency = isset($v['data_currency']) ? $v['data_currency'] : '';
    $data_check = isset($v['data_check']) ? $v['data_check'] : '';
    $sql_data_list = "
    INSERT INTO `billing_payment_list`(
        `data_number_id`,
        `amount`,
        `currency`,
        `id_refer_bp`,
        `currency_number`,
        `status_list`
    )
    VALUES(
        '$data_number_id',
        '$amount',
        '$currency',
        '$last_id',
        '$data_currency',
        '$data_check'
    )
    ";
    
    if ($con->query($sql_data_list) === TRUE) {
        $res_detail_list = '1';
    } else {
        $res_detail_list = '0';
    }
}


echo json_encode(array('res_detail_title'=>$res_detail_title,'res_detail_list'=>$res_detail_list))




?>