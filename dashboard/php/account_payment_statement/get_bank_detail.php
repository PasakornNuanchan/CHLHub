<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';



$sql_data_bank_detail = "
SELECT ID,bank_code FROM bank_account_corp WHERE bank_code is not null;
";


$result = $con->query($sql_data_bank_detail);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $bank[] = $row;
    }
} else {
    $bank = "0 results";
}
echo json_encode(array('bank' => $bank));
