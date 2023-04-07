<?php
require '../../core/conn.php';
require '../../function/auth/get_session.php';

$id_req = $_POST['id_req'];

$result = $con->query("SELECT `pic` FROM `transac_recript_petty_cash` WHERE `ID` = '$id_req' ");

while ($row = $result->fetch_array()) {

    $test = $row[0];
}
echo json_encode($test);


?>