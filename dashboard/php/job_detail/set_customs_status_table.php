<?php

include '../../core/conn.php';
require '../../function/auth/get_session.php';
include '../../core/con_path.php';

// echo $data_user;
// echo $t_time_save;
// echo $type_data_update = $_POST['type_st'];
// echo $context_problem = $_POST['input_data'];
// echo $id_number = $_POST['id'];

$type_data_update = $_POST['type_st'];
$id_number = $_POST['id'];

if($type_data_update == "inv"){
    $sql_update_data = "
    UPDATE
        `job_status`
    SET
        `INV_check_by` = '$data_user',
        `inv_check_datetime` = '$t_time_save'
    WHERE
        ID = '$id_number'
    ";
}elseif($type_data_update == "bl"){
    $sql_update_data = "
    UPDATE
        `job_status`
    SET
        `BL_check_by` = '$data_user',
        `bl_check_datetime` = '$t_time_save'
    WHERE
        ID = '$id_number'
    ";
}elseif($type_data_update == "pl"){
    $sql_update_data = "
    UPDATE
        `job_status`
    SET
        `PL_check_by` = '$data_user',
        `pl_check_datetime` = '$t_time_save'
    WHERE
        ID = '$id_number'
    ";
}elseif($type_data_update == "id"){
    $sql_update_data = "
    UPDATE
        `job_status`
    SET
        `ID_check_by` = '$data_user',
        `id_check_datetime` = '$t_time_save'
    WHERE
        ID = '$id_number'
    ";
}elseif($type_data_update == "il"){
    $sql_update_data = "
    UPDATE
        `job_status`
    SET
        `ID_check_by` = '$data_user',
        `il_check_datetime` = '$t_time_save'
    WHERE
        ID = '$id_number'
        ";
}
//echo $sql_update_data;

$result = $con->query($sql_update_data);
if ($result->num_rows == 0) {
    $arr_res = '1';
} else {
    $arr_res = '0';
}

echo json_encode($arr_res);



?>