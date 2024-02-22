<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';


$data = $_POST['data'] ? $_POST['data'] : '';

$result = $con->query("SELECT `image_file` FROM `billing_receipt` WHERE ID = '$data'");

while ($row = $result->fetch_array()) {

    $test = $row[0];
}
echo json_encode($test);
