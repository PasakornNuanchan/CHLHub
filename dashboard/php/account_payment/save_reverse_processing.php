
<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';

$arr_data_title = $_POST['arr_data_title'] ? $_POST['arr_data_title'] : '';
$arr_data_list = $_POST['arr_data_list'] ? $_POST['arr_data_list'] : '';
$arr_data_list_ins = $_POST['arr_data_list_ins'] ? $_POST['arr_data_list_ins'] : '';


foreach($arr_data_title as $k => $v){
   
    $id_payment = isset($v['id_payment']) ? $v['id_payment'] : '';
    $actual_pay = isset($v['actual_pay']) ? $v['actual_pay'] : '';
    $data_join = isset($v['data_join']) ? $v['data_join'] : '';
   
    $sql_query_data_title = "
    UPDATE
    `billing_payment`
    SET
        `paid_amt` = '$actual_pay',
        `total_payment` = '$actual_pay',
        `ref_billing` = '$data_join'
    WHERE
        ID = '$id_payment'
    ";

    // echo $sql_query_data_title;
    if ($con->query($sql_query_data_title) === TRUE) {
        $last_id = $con->insert_id;
        $billing_payment = '1';
    } else {
        $billing_payment = '0';
    }
}

foreach($arr_data_list_ins as $k => $v){
    $data_id = isset($v['data_id']) ? $v['data_id'] : '';
    $id_bp = isset($v['id_bp']) ? $v['id_bp'] : '';
    $currency_to = isset($v['currency_to']) ? $v['currency_to'] : '';
    $id_currency = isset($v['id_currency']) ? $v['id_currency'] : '';
    $incv_wrute_off = isset($v['incv_wrute_off']) ? $v['incv_wrute_off'] : '';

    $sql_query_data_list = "
    INSERT INTO `billing_payment_list`(
        `data_number_id`,
        `amount`,
        `currency`,
        `id_refer_bp`,
        `currency_number`
    )
    VALUES(
        '$data_id',
        '$incv_wrute_off',
        '$currency_to',
        '$id_bp',
        '$id_currency'
    )
    ";

    if ($con->query($sql_query_data_list) === TRUE) {
        $billing_payment_list = '1';
    } else {
        $billing_payment_list = '0';
    }
}

foreach($arr_data_list as $k => $v){
    $data = isset($v) ? $v : '';

    $sql_query_data_list = "
    DELETE
    FROM
        `billing_payment_list`
    WHERE
        data_number_id = '$data'
    ";
   
    // echo $sql_query_data_list;
    if ($con->query($sql_query_data_list) === TRUE) {
        $billing_payment_list = '1';
    } else {
        $billing_payment_list = '0';
    }
}

echo json_encode(array('billing_payment'=>$billing_payment,'billing_payment_list'=>$billing_payment_list))




?>