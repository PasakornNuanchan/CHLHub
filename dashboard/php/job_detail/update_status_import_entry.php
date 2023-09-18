<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';


$ats_data = $_POST['ats_data'] == "" ? '' : $_POST['ats_data'];
$id_number = $_POST['id_number'];


$sql_update = "
UPDATE
    `job_title`
SET
    do_number = '$ats_data',
    do_number_by = '$data_user'
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

