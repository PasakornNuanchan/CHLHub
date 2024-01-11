<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';


$corp_billto = $_POST['corp_billto'] ? $_POST['corp_billto'] : '';
$tax_id_billto = $_POST['tax_id_billto'] ? $_POST['tax_id_billto'] : '';
$address_billto = $_POST['address_billto'] ? $_POST['address_billto'] : '';

$sql_save_data = "
INSERT INTO `internal_transport_payto`(`corp_name`, `tax_id`, `address`)
VALUES(
    '$corp_billto',
    '$tax_id_billto',
    '$address_billto'
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
