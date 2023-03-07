<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
include '../../core/con_path.php';
include '../../function/auth/run_advance_cash_number.php';


$list_data = $_POST['arr_adc_detail'];
$data_title = $_POST['arr_adc_title'];


foreach($list_data as $k => $v){
    $get_description = isset($v['get_description']) ? $v['get_description'] : '';
    $get_amount = isset($v['get_amount']) ? $v['get_amount'] : '';
    $get_currency = isset($v['get_currency']) ? $v['get_currency'] : '';
    $get_check_id = isset($v['get_check_id']) ? $v['get_check_id'] : '';

    $sql_insert_detail = "
    INSERT INTO `advance_cash_detail`(
        `advance_cash_number`,
        `job_number`,
        `amount`,
        `currency`,
        `id_job_req`
    )
    VALUES(
        '$run_doc',
        '$get_description',
        '$get_amount',
        '$get_currency',
        '$get_check_id'
    )
    ";

   $sql_update_status_cash = "
    UPDATE
        `cash_payment`
    SET
        `status` = '2'
    WHERE
        ID IN ($get_check_id)

    ";

    $status_detail = $con->query($sql_insert_detail);
    $status_detail_update_cash = $con->query($sql_update_status_cash);
    
}

foreach($data_title as $k => $v){
    $get_method = isset($v['get_method']) ? $v['get_method'] : '';
    
    if($get_method == 'Cash'){
        $data_bank_name = '';
        $data_bank_number = '';
    }

    $sql_insert_title = "
    INSERT INTO `advance_cash_title`(
        `advance_cash_number`,
        `request_by`,
        `datetime_request`,
        `tranfer_method_request`,
        `tranfer_bank_name`,
        `tranfer_bank_number`
    )
    VALUES(
        '$run_doc',
        '$data_user',
        '$t_time_save',
        '$get_method',
        '$data_bank_name',
        '$data_bank_number'
    )
    ";
    
    $status_title = $con->query($sql_insert_title);
}

echo json_encode($run_doc);



?>
