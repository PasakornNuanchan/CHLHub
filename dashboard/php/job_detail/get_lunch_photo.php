<?php
include '../../core/conn.php';

$type_data_request = $_POST['type_request'];
$id_data_request = $_POST['id_request'];


$result = $con->query("SELECT $type_data_request FROM job_status WHERE ID = '$id_data_request'");

while ($row = $result->fetch_array()) {

    $test = $row[0];
}
echo json_encode($test);

?>