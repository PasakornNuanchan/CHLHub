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
$context_problem = $_POST['input_data'];
$id_number = $_POST['id'];


if($type_data_update == "cf_sa"){
    $sql_update_data = "
    UPDATE
        `job_status`
    SET
        `ship_arrievd_st` = '$t_time_save',
        `ship_arrievd_by` = '$data_user',
        `ship_arrived_status` = '1',
        `ship_pro` = ''
    WHERE
        ID ='$id_number'
    ";
}elseif($type_data_update == "tb_sa"){
    $sql_update_data = "
    UPDATE
        `job_status`
    SET
        `ship_arrievd_st` = '$t_time_save',
        `ship_arrievd_by` = '$data_user',
        `ship_arrived_status` = '2',
        `ship_pro` = '$context_problem'
    WHERE
        ID ='$id_number'
    ";
}elseif($type_data_update == "cf_dr"){
    $sql_update_data = "
    UPDATE
        `job_status`
    SET
        `drop_status` = '1',
        `drop_datetime` = '$t_time_save',
        `drop_by` = '$data_user',
        `drop_pro` = ''
    WHERE
        ID ='$id_number'
    ";
}elseif($type_data_update == "tb_dr"){
    $sql_update_data = "
    UPDATE
        `job_status`
    SET
        `drop_status` = '2',
        `drop_datetime` = '$t_time_save',
        `drop_by` = '$data_user',
        `drop_pro` = '$context_problem'
    WHERE
        ID ='$id_number'
    ";
}elseif($type_data_update == "cf_cc"){
    $sql_update_data = "
    UPDATE
        `job_status`
    SET
        `Cus_suc_datetime` = '$t_time_save',
        `Cus_by` = '$data_user',
        `Cus_status` = '1',
        `cus_pro` = ''
    WHERE
        ID ='$id_number'
    ";
}elseif($type_data_update == "tb_cc"){
    $sql_update_data = "
    UPDATE
        `job_status`
    SET
        `Cus_suc_datetime` = '$t_time_save',
        `Cus_by` = '$data_user',
        `Cus_status` = '2',
        `cus_pro` = '$context_problem'
    WHERE
        ID ='$id_number'
    ";
}elseif($type_data_update == "cf_up"){
    $sql_update_data = "
    UPDATE
    `container`
    SET
        `up_status_cntr` = '1',
        `up_datetime_cntr` = '$t_time_save',
        `up_by_cntr` = '$data_user',
        `up_pro_cntr` = ''
    WHERE
        ID = '$id_number'
    ";
}elseif($type_data_update == "tb_up"){
    $sql_update_data = "
    UPDATE
    `container`
    SET
        `up_status_cntr` = '2',
        `up_datetime_cntr` = '$t_time_save',
        `up_by_cntr` = '$data_user',
        `up_pro_cntr` = '$context_problem'
    WHERE
        ID = '$id_number'
    ";
}elseif($type_data_update == "cf_ar"){
    $sql_update_data = "
    UPDATE
    `container`
    SET
    `cntr_status_ar` = '1',
    `cntr_up_by` = '$data_user',
    `cntr_datetime` = '$t_time_save',
    `cntr_pro` = ''
    WHERE
        ID = '$id_number'
    ";
}elseif($type_data_update == "tb_ar"){
    $sql_update_data = "
    UPDATE
    `container`
    SET
    `cntr_status_ar` = '2',
    `cntr_up_by` = '$data_user',
    `cntr_datetime` = '$t_time_save',
    `cntr_pro` = '$context_problem'
    WHERE
        ID = '$id_number'
    ";
}elseif($type_data_update == "cf_cy"){
    $sql_update_data = "
    UPDATE
    `container`
    SET
    `cy_status_cntr` = '1',
    `cy_datetime_cntr` = '$t_time_save',
    `cy_by_cntr` = '$data_user',
    `cy_pro_cntr` = ''
    WHERE
        ID = '$id_number'
    ";
}elseif($type_data_update == "tb_cy"){
    $sql_update_data = "
    UPDATE
    `container`
    SET
    `cy_status_cntr` = '2',
    `cy_datetime_cntr` = '$t_time_save',
    `cy_by_cntr` = '$data_user',
    `cy_pro_cntr` = '$context_problem'
    WHERE
        ID = '$id_number'
    ";
}

$result = $con->query($sql_update_data);
if ($result->num_rows == 0) {
    $arr_res = '1';
} else {
    $arr_res = '0';
}

echo json_encode($arr_res);



?>