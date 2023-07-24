<?php
include '../../core/conn.php';
date_default_timezone_set("Asia/Bangkok");
$t_time = (date("Y-m-d H:i:sa"));
$t_time_save =substr($t_time,0,19);

$ats_data = $_POST['ats_data'] == "pleses select shipping" ? '' : $_POST['ats_data'];
$id_number = $_POST['id_number'];


$sql_update = "
UPDATE
    `job_title`
SET
    shipping_ass = '$ats_data'
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

