<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
include '../../core/con_path.php';

$status = $_POST['type_st'] ? $_POST['type_st'] : '';
$data_in = $_POST['input_data'] ? $_POST['input_data'] : '';
$job_number = $_POST['job_number'] ? $_POST['job_number'] : '';
$id = $_POST['id'] ? $_POST['id'] : '';

if($status == "saf"){
    $sql = "
    UPDATE
    `job_status`
SET
    `ship_arrievd_st` = '$t_time_save',
    `ship_arrievd_by` = '$data_user',
    `ship_arrived_status` = '1',
    `ship_pro` = ''
WHERE
    `job_number` = '$job_number'
    ";
}elseif($status == "satb"){
    $sql = "
    UPDATE
    `job_status`
SET
    `ship_arrievd_st` = '$t_time_save',
    `ship_arrievd_by` = '$data_user',
    `ship_arrived_status` = '2',
    `ship_pro` = '$data_in'
WHERE
    `job_number` = '$job_number'
    ";
}elseif($status == "ccf"){
    $sql = "
    UPDATE
    `job_status`
SET
    `Cus_suc_datetime` = '$t_time_save',
    `Cus_by` = '$data_user',
    `Cus_status` = '1',
    `cus_pro` = ''
WHERE
    `job_number` = '$job_number'
    ";
}elseif($status == "cctb"){
    $sql = "
    UPDATE
    `job_status`
SET
    `Cus_suc_datetime` = '$t_time_save',
    `Cus_by` = '$data_user',
    `Cus_status` = '2',
    `cus_pro` = '$data_in'
WHERE
    `job_number` = '$job_number'
    ";
}elseif($status == "upl_f"){
    $sql = "
    UPDATE
    `container`
SET
    `up_status_cntr` = '1',
    `up_datetime_cntr` = '$t_time_save',
    `up_by_cntr` = '$data_user',
    `up_pro_cntr` = ''
WHERE
    `ID` = '$id'
    ";
}elseif($status == "upl_t"){
    $sql = "
    UPDATE
    `container`
SET
    `up_status_cntr` = '2',
    `up_datetime_cntr` = '$t_time_save',
    `up_by_cntr` = '$data_user',
    `up_pro_cntr` = '$data_in'
WHERE
    `ID` = '$id'
    ";
}

elseif($status == "cdf"){
    $sql = "
    UPDATE
    `job_status`
SET
    `drop_status` = '1',
    `drop_datetime` = '$t_time_save',
    `drop_by` = '$data_user',
    `drop_pro` = ''
WHERE
    `job_number` = '$job_number'
    ";
}elseif($status == "cdt"){
    $sql = "
    UPDATE
    `job_status`
SET
    `drop_status` = '2',
    `drop_datetime` = '$t_time_save',
    `drop_by` = '$data_user',
    `drop_pro` = '$data_in'
WHERE
    `job_number` = '$job_number'
    ";
}elseif($status == "conar_f"){
    $sql = "
    UPDATE
    `container`
SET
    `cntr_status_ar` = '1',
    `cntr_datetime` = '$t_time_save',
    `cntr_up_by` = '$data_user',
    `cntr_pro` = ''
WHERE
`ID` = '$id'
    ";
}elseif($status == "conar_t"){
    $sql = "
    UPDATE
    `container`
SET
    `cntr_status_ar` = '2',
    `cntr_datetime` = '$t_time_save',
    `cntr_up_by` = '$data_user',
    `cntr_pro` = '$data_in'
WHERE
`ID` = '$id'
    ";
}elseif($status == "cyf"){
    $sql = "
    UPDATE
    `container`
SET
    `cy_status_cntr` = '1',
    `cy_datetime_cntr` = '$t_time_save',
    `cy_by_cntr` = '$data_user',
    `cy_pro_cntr` = ''
WHERE
`ID` = '$id'
    ";
}elseif($status == "cyt"){
    $sql = "
    UPDATE
    `container`
SET
    `cy_status_cntr` = '2',
    `cy_datetime_cntr` = '$t_time_save',
    `cy_by_cntr` = '$data_user',
    `cy_pro_cntr` = '$data_in'
WHERE
`ID` = '$id'
    ";
}

$status = $con->query($sql);
echo json_encode($status);


