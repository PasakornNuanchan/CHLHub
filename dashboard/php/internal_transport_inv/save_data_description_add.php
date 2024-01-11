<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';

$data_description = $_POST['data_description'];

$sql_save_data = "
INSERT INTO `internal_transport_description`(
    `description_name`
)
VALUES(
    '$data_description'
)
        ";



// echo $sql_save_data;
$result = $con->query($sql_save_data);
if ($result->num_rows == 0) {
    $data_save_description = '1';
} else {
    $data_save_description = '0';
}


echo json_encode($data_save_description);
