<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
include '../../core/con_path.php';

$arr_data = $_POST['arr_data'];



foreach($arr_data as $k => $v){

    $data_id = isset($v['data_id']) ? $v['data_id'] : '';
    $data_pay = isset($v['data_pay']) ? $v['data_pay'] : '';
    $data_file = isset($v['data_file']) ? $v['data_file'] : '';
    
    $sql = "
    UPDATE
        `cash_pay`
    SET
        `datetime_paid` = '$t_time_save',
        `paid_by` = '$data_user',
        `img_pay` = '$data_file',
        `type_pay` = '$data_pay'
    WHERE
        ID = '$data_id'
    ";

    if ($con->query($sql) === TRUE) {
        $res_in_job_title = '1';
    } else {
        $res_in_job_title = '0';
    }
}

echo json_encode($res_in_job_title)




?>