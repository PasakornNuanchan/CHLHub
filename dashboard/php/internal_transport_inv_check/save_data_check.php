<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';

$arr_data_save = $_POST['arr_data_save'] ? $_POST['arr_data_save'] : '';


$sql_save_data = "
UPDATE
    `transport_statement`
SET
    `ID` = '[value-1]',
    `ref_job_id` = '[value-2]',
    `description` = '[value-3]',
    `pay_to` = '[value-4]',
    `qty` = '[value-5]',
    `price` = '[value-6]',
    `vat` = '[value-7]',
    `total` = '[value-8]',
    `currency` = '[value-9]',
    `receipt` = '[value-10]',
    `type_file` = '[value-11]',
    `name_file` = '[value-12]',
    `remark` = '[value-13]',
    `create_by` = '[value-14]',
    `create_datetime` = '[value-15]',
    `check_by` = '[value-16]',
    `check_date` = '[value-17]',
    `generate_by` = '[value-18]',
    `generate_date` = '[value-19]'
WHERE
    1
)";



// echo $sql_save_data;
$result = $con->query($sql_save_data);
if ($result->num_rows == 0) {
    $data_save_description = '1';
} else {
    $data_save_description = '0';
}


echo json_encode($data_save_description);
