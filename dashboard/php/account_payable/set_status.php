<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';



$arr_data_sent_status = $_POST['arr_data_sent_status'];
$arr_data_sent_approve = $_POST['arr_data_sent_approve'];

if($arr_data_sent_status != ''){
    foreach ($arr_data_sent_status as $k => $v) {

        $id_number = isset($v['id_number']) ? $v['id_number'] : '';
        $data_checked = isset($v['data_checked']) ? $v['data_checked'] : '';
    
        $sql_query_data_stauts = "
        UPDATE
            `billing`
        SET
            `approve_by` = '$data_user',
            `approve_date_time` = '$t_time_save',
            `status` = '$data_checked'
        WHERE
            `ID` = '$id_number'
        ";
    
        $result = $con->query($sql_query_data_stauts);
        if ($result->num_rows == 0) {
            $res_status = '1';
        } else {
            $res_status = '0';
        }
    }
}else{
    $res_status = '1';
}

if($arr_data_sent_approve != ''){
    foreach ($arr_data_sent_approve as $k => $v) {

        $id_number = isset($v['id_number']) ? $v['id_number'] : '';
        $chx_pre_approve = isset($v['chx_pre_approve']) ? $v['chx_pre_approve'] : '';
    
        $sql_query_data_approve = "
        UPDATE
            `billing`
        SET
            `pre_approve_by` = '$data_user',
            `pre_approve_dt` = '$t_time_save',
            `pre_approve_status` = '$chx_pre_approve'
        WHERE
        `ID` = '$id_number'
        ";
        $result = $con->query($sql_query_data_approve);
        if ($result->num_rows == 0) {
            $res_approve = '1';
        } else {
            $res_approve = '0';
        }
    }
}else{
    $res_approve = '1';

}






echo json_encode((array('res_status'=>$res_status,'res_approve'=>$res_approve)))
?>