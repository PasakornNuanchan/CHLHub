<?php

$t_time_save_year = substr($t_time_save, 2, 2) . substr($t_time_save, 5, 2);

$sql_last_rows = "
SELECT 
    advance_cash_number 
FROM 
    advance_cash_title 
ORDER BY ID DESC LIMIT 1
";

$result = $con->query($sql_last_rows);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $last_advance_cash_number = $row;
    }
} else {
    $last_advance_cash_number = "0 results";
}


$lacn_year = substr($last_advance_cash_number['advance_cash_number'], 2, 4);
$lacn_number = substr($last_advance_cash_number['advance_cash_number'], 6, 3);
$lacn_number1 = (int)substr($lacn_number, 0, 1);
$lacn_number2 = (int)substr($lacn_number, 1, 1);
$lacn_number3 = (int)substr($lacn_number, 2, 1);
$run_doc = 0;


if ($t_time_save_year == $lacn_year) {
    if ($lacn_number3 == 9 && $lacn_number2 == 9) { //หลักร้อย
        $res_val3 = 0;
        $res_val2 = 0;
        $res_val1 = $lacn_number1+1;
        $run_doc = $res_val1 . $res_val2 . $res_val3;
    } else {
        if ($lacn_number3 < 9) { // หลักหน่วย
            $res_val3 = (int)$lacn_number3 + 1;
            $run_doc = $lacn_number1 . $lacn_number2 . $res_val3;
        } else { //หลักสิบ
            $res_val3 = 0;
            $res_val2 = (int)$lacn_number2 + 1;
            $run_doc = $lacn_number1 . $res_val2 . $res_val3;
        }
    }
    $run_doc = "AD".$t_time_save_year.$run_doc;
} else {

    $run_doc = "001";
    $run_doc = "AD".$t_time_save_year.$run_doc;
}


?>