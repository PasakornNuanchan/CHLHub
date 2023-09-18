<?php
include '../../core/conn.php';

$type_data_request = $_POST['type_request'];
$id_data_request = $_POST['id_request'];
$type_data = $_POST['type_data'];


$result = $con->query("SELECT $type_data_request,$type_data FROM job_status WHERE ID = '$id_data_request'");

while ($row = $result->fetch_array()) {

    $request = $row[$type_data_request];
    $type_data = $row[$type_data];
}
echo json_encode(array('request'=>$request,'type_data'=>$type_data));

?>