<?php
include '../../core/conn.php';
date_default_timezone_set("Asia/Bangkok");
$t_time = (date("Y-m-d H:i:sa"));
$t_time_save =substr($t_time,0,19);

$type_request = $_POST['type_request'];
$id_number = $_POST['id_number'];

if($type_request == "do"){
    $type_sent = "pickup_DO_date";
}elseif($type_request == "cd"){
    $type_sent = "check_document";
}elseif($type_request == "en"){
    $type_sent = "enter_date";
}elseif($type_request == "clear"){
    $type_sent = "clearlance_date";
}

$sql_update = "
UPDATE
    `job_title`
SET
    $type_sent = '$t_time_save'
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

