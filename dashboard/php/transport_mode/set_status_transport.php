<?php

include '../../core/conn.php';

$container_id = $_POST['container_id'] ? $_POST['container_id'] : '';
$type_data = $_POST['type_data'] ? $_POST['type_data'] : '';

date_default_timezone_set("Asia/Bangkok");

$t_time = (date("Y-m-d H:i:sa"));
$t_time_save =substr($t_time,0,19);


if($type_data == 'dr'){
    $sql_query_data = "
    UPDATE
        `container`
    SET
        `cntr_status_ar` = '1',
        `cntr_up_by` = '00000',
        `cntr_datetime` = '$t_time_save'
    WHERE
        ID = '$container_id'
    ";
}
if($type_data == 'rtn'){
    $sql_query_data = "
    UPDATE
        `container`
    SET
        `cy_status_cntr` = '1',
        `cy_datetime_cntr` = '$t_time_save',
        `cy_by_cntr` = '00000'
    WHERE
        ID = '$container_id'
    ";
}
//echo $sql_query_data;
$result = $con->query($sql_query_data);
    if ($result->num_rows == 0) {
        $arr_save_detail = '1';
    } else {
        $arr_save_detail = '0';
    }
echo json_encode($arr_save_detail);
?>