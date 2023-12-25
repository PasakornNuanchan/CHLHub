<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';


$arr_data_sys_rate = $_POST['arr_data_sys_rate'] ? $_POST['arr_data_sys_rate'] : '';

$sql_get_currency = "
SELECT
	jt.ID,
    jt.job_number,
    jt.create_date,
    sr.*
FROM
    job_title jt
WHERE
    jt.job_number IN ($arr_data_sys_rate)
";



// echo $sql_data_table;

$result = $con->query($sql_get_currency);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $currency[] = $row;
    }
} else {
    $currency = "0 results";
}
echo json_encode(array('currency' => $currency));
