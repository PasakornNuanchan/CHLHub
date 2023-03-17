<?php
require '../../core/conn.php';
require '../../function/auth/get_session.php';

$type = $_POST['type'];
$valid = $_POST['valid'];


// echo $sql = "
// SELECT
//     `$type`
// FROM
//     `job_status`
// WHERE
//     `ID` = '$valid'

// ";



$result = $con->query(" SELECT `$type` FROM `job_status` WHERE `ID` = '$valid' ");
while ($row = $result->fetch_array()) {

    $test = $row[0];
}
echo json_encode($test);


?>