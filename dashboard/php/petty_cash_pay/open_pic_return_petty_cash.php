<?php
require '../../core/conn.php';

$id_req = $_POST['data'];

$result = $con->query("SELECT `return_payment_receipt` FROM `petty_cash_title` WHERE `ID` = '$id_req' ");

while ($row = $result->fetch_array()) {

    $test = $row[0];
}
echo json_encode($test);


?>