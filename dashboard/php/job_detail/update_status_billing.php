<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
include '../../core/con_path.php';

$id_action = $_POST['data_id'];
$type_action = $_POST['type_action'];


if($type_action == '1'){

    $sql_update = "
    UPDATE
        `billing`
    SET
        `action_paid_by` = '$data_user',
        `action_paid_date_time` = '$t_time_save',
        `payble` = '1',
        `last_update_by` = '$data_user',
        `last_update_datetime` = '$t_time_save'
    WHERE
        ID = '$id_action'
    ";

   
}else{
    $sql_update = "
    UPDATE
        `billing`
    SET
        `check_by` = '$data_user',
        `check_date_time` = '$t_time_save',
        `last_update_by` = '$data_user',
        `last_update_datetime` = '$t_time_save'
    WHERE
        ID = '$id_action'
    ";
}

$result = $con->query($sql_update);
if ($result->num_rows == 0) {
    $arr_res = '1';
} else {
    $arr_res = '0';
}


echo json_encode(array('arr_res'=>$arr_res));


?>