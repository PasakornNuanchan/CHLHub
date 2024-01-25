
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
    $type_data = isset($v['type_data']) ? $v['type_data'] : '';
    $name_file = isset($v['name_file']) ? $v['name_file'] : '';
    $Base_64_file_base = isset($v['Base_64_file_base']) ? $v['Base_64_file_base'] : '';
    $payment_date = $payment_date == '' ? 'null' : "'$payment_date'";
    $write_off_date = $write_off_date == '' ? 'null' : "'$write_off_date'";
    $data_currency_start = isset($v['data_currency_start']) ? $v['data_currency_start'] : '';
    $data_currency_write_off = isset($v['data_currency_write_off']) ? $v['data_currency_write_off'] : '';
    $data_hanler = isset($v['data_hanler']) ? $v['data_hanler'] : '';
    $data_sale = isset($v['data_sale']) ? $v['data_sale'] : '';

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
        `sale`
    
    )
    VALUES(
        '$data_user',
        '$t_time_save',
        '1',
        '$amount_payment',
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
        '$Base_64_file_base',
        '$type_data',
        '$name_file',
        '$data_currency_start',
        '$data_currency_write_off',
        '$data_hanler',
        '$data_sale'

    )
    ";
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

    $sql_data_list = "
    INSERT INTO `billing_payment_list`(
        `data_number_id`,
        `amount`,
        `currency`,
        `id_refer_bp`,
        `currency_number`
    )
    VALUES(
        '$data_number_id',
        '$amount',
        '$currency',
        '$last_id',
        '$data_currency'
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