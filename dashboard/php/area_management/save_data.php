<?php
include '../../core/conn.php';

$data_port = $_POST['data_port'];
$data_provice = $_POST['data_provice'];

$sql_save_data = "
INSERT INTO `area`(
    `location_name`,
    `provice`
)
VALUES(
    '$data_port',
    '$data_provice'
)
";


if ($con->query($sql_save_data) === TRUE) {
    $res = '1';
} else {
    $res = '0';
}

echo json_encode($res)
?>