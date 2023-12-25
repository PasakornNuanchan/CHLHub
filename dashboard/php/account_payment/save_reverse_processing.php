
<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';

$arr_data_title = $_POST['arr_data_title'] ? $_POST['arr_data_title'] : '';
$arr_data_list = $_POST['arr_data_list'] ? $_POST['arr_data_list'] : '';

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
    // if ($con->query($sql_data_query_title) === TRUE) {
    //     $last_id = $con->insert_id;
    //     $res_detail_title = '1';
    // } else {
    //     $res_detail_title = '0';
    // }
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
    // $data_number_id = isset($v['data_number_id']) ? $v['data_number_id'] : '';
    // $amount = isset($v['amount']) ? $v['amount'] : '';
    // $currency = isset($v['currency']) ? $v['currency'] : '';

    // $sql_data_list = "
    // INSERT INTO `billing_payment_list`(
    //     `data_number_id`,
    //     `amount`,
    //     `currency`,
    //     `id_refer_bp`
    // )
    // VALUES(
    //     '$data_number_id',
    //     '$amount',
    //     '$currency',
    //     '$last_id'
    // )
    // ";
    
    // if ($con->query($sql_data_list) === TRUE) {
    //     $res_detail_list = '1';
    // } else {
    //     $res_detail_list = '0';
    // }
}

// echo json_encode(array('res_detail_title'=>$res_detail_title,'res_detail_list'=>$res_detail_list))




?>