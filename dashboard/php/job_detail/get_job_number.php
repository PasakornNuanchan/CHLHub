<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';

$id_number = $_POST['id_number'];



$result = $con->query("SELECT job_number FROM job_title WHERE ID = '$id_number'");

while ($row = $result->fetch_array()) {

    $test = $row['job_number'];
}
echo json_encode($test);

?>