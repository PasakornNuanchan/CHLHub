<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';


$join_arr_data_find = $_POST['join_arr_data_find'] ? $_POST['join_arr_data_find'] : '';

// foreach($join_arr_data_find as $k => $v){
    $sql_get_currency = "
    SELECT
        jt.job_number,
        sr.*
    FROM
        job_title jt
        LEFT JOIN sys_rate_cur sr ON jt.etd BETWEEN sr.start_date AND sr.end_date
    WHERE
        jt.job_number IN ('$join_arr_data_find')
    
    ";
// }




// echo $sql_get_currency;

$result = $con->query($sql_get_currency);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $currency[] = $row;
    }
} else {
    $currency = "0 results";
}
echo json_encode(array('currency' => $currency));
