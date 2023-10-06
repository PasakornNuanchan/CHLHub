<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';


$arr_data_sent = $_POST['arr_data_sent'];

foreach($arr_data_sent as $k => $v){


    $data_id = isset($v['data_id']) ? $v['data_id'] : '';
    $name_data = isset($v['name_data']) ? $v['name_data'] : '';

    $sql_query_data_status = "
    UPDATE
        `billing`
    SET
        `status` = '$name_data',
        `approve_by` = '$data_user',
        `approve_date_time` = '$t_time_save'
    WHERE
        ID = '$data_id'
    ";
    
    $result = $con->query($sql_query_data_status);
    if ($result->num_rows == 0) {
        $res_arr = '1';
    } else {
        $res_arr = '0';
    }
}

echo json_encode((array('res_arr'=>$res_arr)))

?>