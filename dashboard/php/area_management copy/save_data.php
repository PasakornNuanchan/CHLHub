<?php
include '../../core/conn.php';

$code_name = $_POST['code_name'];
$item_name = $_POST['item_name'];

$sql_save_data = "
INSERT INTO `billing_description`(
    `billing_code`,
    `billing_item_name`
)
VALUES(
    '$code_name',
    '$item_name'
)
";


if ($con->query($sql_save_data) === TRUE) {
    $res = '1';
} else {
    $res = '0';
}

echo json_encode($res)
?>