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
    `bank_account_corp`
";


$sql_data_get_user = "
SELECT
    `ID`,
    `first_name`,
    `last_name`
FROM
    `user`
WHERE
    ID = '$data_user'
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


$result = $con->query($sql_data_get_user);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $user_data_get[] = $row;
    }
} else {
    $user_data_get = "0 results";
}

echo json_encode(array('bank' => $bank,'user_data_get'=>$user_data_get));
