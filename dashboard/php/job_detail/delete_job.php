<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
include '../../core/con_path.php';
$data = $_POST['data_delete'];
//echo $data;

$sql_data_job_status = "
DELETE FROM `job_status` WHERE ref_job_id = '$data'
";

$sql_data_delete_job = "
DELETE FROM `job_title` WHERE ID = '$data' 
";

$sql_data_container = "
DELETE FROM `container` WHERE ref_job_id = '$data'
";

$sql_data_container_information = "
DELETE FROM `container_information` WHERE ref_job_id = '$data'
";

$sql_cash_pay = "
DELETE FROM `cash_pay` WHERE ref_job_id = '$data'
";

$sql_transport ="
DELETE FROM `transport_booking` WHERE ref_job_id = '$data'
";

$sql_driver = "
DELETE FROM `transport_contact` WHERE ref_job_id = '$data'
";
// $sql_data_job_status
// $sql_data_delete_job
// $sql_data_container
// $sql_data_container_information


$result = $con->query($sql_driver);
$result = $con->query($sql_transport);
$result = $con->query($sql_cash_pay);
$result = $con->query($sql_data_container_information);
$result = $con->query($sql_data_container);
$result = $con->query($sql_data_delete_job);
$result = $con->query($sql_data_job_status);


?>