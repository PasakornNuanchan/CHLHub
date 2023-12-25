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
    (SELECT u1.first_name FROM user u1 WHERE u1.ID = jt.sale_support) sale_f,
    (SELECT u1.last_name FROM user u1 WHERE u1.ID = jt.sale_support) sale_l,
    (SELECT u2.first_name FROM user u2 WHERE u2.ID = jt.cs_support) cs_f,
    (SELECT u2.last_name FROM user u2 WHERE u2.ID = jt.cs_support) cs_l,
    sr.*
FROM
    job_title jt
    LEFT JOIN sys_rate_cur sr ON jt.create_date BETWEEN sr.start_date AND sr.end_date

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
