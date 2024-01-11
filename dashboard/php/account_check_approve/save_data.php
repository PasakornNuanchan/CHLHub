<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';


$arr_data = $_POST['arr_data'];

foreach ($arr_data as $k => $v) {
    $data_id = isset($v['data_id']) ? $v['data_id'] : '';
    $sql_data_query = "
            UPDATE
                `billing`
            SET   
                `check_by` = '$data_user',
                `check_date_time` = '$t_time_save'
            WHERE
                ID ='$data_id'
            ";
    $result = $con->query($sql_data_query);
    if ($result->num_rows == 0) {
        $res_arr = '1';
    } else {
        $res_arr = '0';
    }
}

echo json_encode($res_arr);
