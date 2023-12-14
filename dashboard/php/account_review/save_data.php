<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';


$arr_data = $_POST['arr_data'];



foreach ($arr_data as $k => $v) {
    $data_id = isset($v['data_id_number']) ? $v['data_id_number'] : '';
    $data_radio_select_type = isset($v['data_radio_select_type']) ? $v['data_radio_select_type'] : '';
    $data_start = isset($v['data_start']) ? $v['data_start'] : '';

    if($data_radio_select_type != '0'){
        $sql_data_query = "
        UPDATE
            `billing`
        SET
            `approve_by` = '$data_user',
            `approve_date_time` = '$t_time_save',
            `status` = '$data_radio_select_type'
        WHERE
            ID = '$data_id'
       ";
    }else{
        $sql_data_query = "
        UPDATE
            `billing`
        SET
            `approve_by` = null,
            `approve_date_time` = null,
            `status` = '$data_radio_select_type'
        WHERE
            ID = '$data_id'
       ";
    }
    

    //    echo $sql_data_query;
    $result = $con->query($sql_data_query);
    if ($result->num_rows == 0) {
        $res_arr = '1';
    } else {
        $res_arr = '0';
    }
}

echo json_encode($res_arr);
