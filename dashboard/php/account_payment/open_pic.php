<?php
require '../../core/conn.php';

$id_req = $_POST['data'];

$result = $con->query("SELECT `receipt` FROM `billing_payment` WHERE `ID` = '$id_req' ");

while ($row = $result->fetch_array()) {

    $test = $row[0];
}
echo json_encode($test);


?>