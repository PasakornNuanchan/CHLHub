<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';


$data_radio_process = $_POST['data_radio_process'];
$arr_data = $_POST['arr_data'];
$data_radio_select_act = $_POST['data_radio_select_act'];


foreach($arr_data as $k => $v){
    $data_id = isset($v['data_id']) ? $v['data_id'] : '';
    

    if($data_radio_select_act == "check"){
        if($data_radio_process == "process"){
            $sql_data_query = "
            UPDATE
                `billing`
            SET   
                `check_by` = '$data_user',
                `check_date_time` = '$t_time_save'
            WHERE
                ID ='$data_id'
            ";
        }else{
            $sql_data_query = "
            UPDATE
                `billing`
            SET   
                `check_by` = null,
                `check_date_time` = null
            WHERE
                ID ='$data_id'
            ";
        }
    }else{
        if($data_radio_process == "process"){
            $sql_data_query = "
            UPDATE
                `billing`
            SET   
                `action_paid_by` = '$data_user',
                `action_paid_date_time` = '$t_time_save'
            WHERE
                ID ='$data_id'
            ";
        }else{
            $sql_data_query = "
            UPDATE
                `billing`
            SET   
                `action_paid_by` = null,
                `action_paid_date_time` = null
            WHERE
                ID ='$data_id'
            ";
        }
    }
    

    $result = $con->query($sql_data_query);
    if ($result->num_rows == 0) {
        $res_arr = '1';
    } else {
        $res_arr = '0';
    }
}

echo json_encode($res_arr);

