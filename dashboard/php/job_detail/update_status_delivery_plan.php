<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';


$delivery_plan = isset($_POST['delivery_plan']) ? $_POST['delivery_plan'] : '';
$id_number = isset($_POST['id_number']) ? $_POST['id_number'] : '';


$sql_update = "
UPDATE
    `job_title`
SET
    delivery_plan = '$delivery_plan',
    delivery_plan_by = '$data_user',
    delivery_plan_datetime = '$t_time_save'
WHERE
    ID = '$id_number'
";

$result = $con->query($sql_update);
if ($result->num_rows == 0) {
    $arr_res = '1';
} else {
    $arr_res = '0';
}


echo json_encode(array('arr_res'=>$arr_res));

