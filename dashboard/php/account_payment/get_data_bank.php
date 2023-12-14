<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';

$sql_data_bank = "
    SELECT
    `ID`,
    `location`,
    `country`,
    `payment_menthod`,
    `bank_code`,
    `company_name`,
    `bank_account`,
    `currency`,
    `bank_brunch`,
    `bank_address`,
    `swift_code`,
    `bank_telephone`,
    `commercial_number`,
    `tax_number`,
    `create_by`,
    `create_datetime`,
    `last_modify_by`,
    `last_modify_datetime`
FROM
    `acbank`
";


// echo $sql_data_table;

$result = $con->query($sql_data_bank);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $bank[] = $row;
    }
} else {
    $bank = "0 results";
}
echo json_encode(array('bank' => $bank));
