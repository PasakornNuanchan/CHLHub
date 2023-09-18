<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';

$type_request = $_POST['type_request'];
$id_number = $_POST['id_number'];

if($type_request == "do"){
    $type_sent = "pickup_DO_date";
    $filed_by = "pickup_DO_by";
}elseif($type_request == "cd"){
    $type_sent = "check_document";
    $filed_by = "check_document_by";
}elseif($type_request == "en"){
    $type_sent = "enter_date";
    $filed_by = "enter_by";
}elseif($type_request == "clear"){
    $type_sent = "clearlance_date";
    $filed_by = "clearlance_date_by";
}

$sql_update = "
UPDATE
    `job_title`
SET
    $type_sent = '$t_time_save',
    $filed_by = '$data_user'
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

