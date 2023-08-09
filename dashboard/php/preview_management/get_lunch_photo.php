<?php
include '../../core/conn.php';

$type_data_request = $_POST['data_type'];
$id_data_request = $_POST['id_number'];

if($type_data_request == "INV"){
    $data_request = "INV_picture";
}else if($type_data_request == "BL"){
    $data_request = "BL_picture";
}else if($type_data_request == "PL"){
    $data_request = "PL_picture";
}else if($type_data_request == "ID"){
    $data_request = "ID_picture";
}else if($type_data_request == "IL"){
    $data_request = "IL_picture";
}


$result = $con->query("SELECT $data_request FROM job_status WHERE ref_job_id = '$id_data_request'");


while ($row = $result->fetch_array()) {

    $test = $row[0];
}
echo json_encode($test);

?>