<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';



$arr_data = $_POST['arr_data'];
foreach($arr_data as $k => $v){
    $id_number = isset($v['id_number']) ? $v['id_number'] : '';
    $ref_job_id = isset($v['ref_job_id']) ? $v['ref_job_id'] : '';
    
    
    $sql_query_data_payment = "
        INSERT INTO `billing_payment`(
            `ref_billing_id`,
            `ref_job_id`,
            `paid_by`,
            `paid_date_time`,
            `status_billing`
        )
        VALUES(
            '$id_number',
            '$ref_job_id',
            '$data_user',
            '$t_time_save',
            '0'
        )
    ";
    
    $result = $con->query($sql_query_data_payment);
    if ($result->num_rows == 0) {
        $res_arr = '1';
    } else {
        $res_arr = '0';
    }
    
}


echo json_encode($res_arr);
// $arr_data = $_POST['arr_data'];


// foreach($arr_data as $k => $v){


//     $data_id = isset($v['data_id']) ? $v['data_id'] : '';
//     $ref_job_id = isset($v['ref_job_id']) ? $v['ref_job_id'] : '';



//     $sql_query_data_payment = "
//     INSERT INTO `billing_payment`(
//         `ref_billing_id`,
//         `ref_job_id`,
//         `paid_by`,
//         `paid_date_time`,
//         `status_billing`
//     )
//     VALUES(
//         '$data_id',
//         '$ref_job_id',
//         '$data_user',
//         '$t_time_save',
//         '0'
//     )
//     ";
