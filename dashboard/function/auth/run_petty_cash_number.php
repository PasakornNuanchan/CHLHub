<?php

$t_time_save_year = substr($t_time_save, 2, 2) . substr($t_time_save, 5, 2);

$sql_last_rows = "
SELECT 
    petty_cash_number 
FROM 
    petty_cash_title 
ORDER BY ID DESC LIMIT 1
";

$result = $con->query($sql_last_rows);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $last_petty_cash_number = $row;
    }
} else {
    $last_petty_cash_number = "0 results";
}


$lpcn_year = substr($last_petty_cash_number['petty_cash_number'], 2, 4);
$lpcn_number = substr($last_petty_cash_number['petty_cash_number'], 6, 3);
$lpcn_number1 = (int)substr($lpcn_number, 0, 1);
$lpcn_number2 = (int)substr($lpcn_number, 1, 1);
$lpcn_number3 = (int)substr($lpcn_number, 2, 1);
$run_doc = 0;


if ($t_time_save_year == $lpcn_year) {
    if ($lpcn_number3 == 9 && $lpcn_number2 == 9) { //หลักร้อย
        $res_val3 = 0;
        $res_val2 = 0;
        $res_val1 = $lpcn_number1+1;
        $run_doc = $res_val1 . $res_val2 . $res_val3;
    } else {
        if ($lpcn_number3 < 9) { // หลักหน่วย
            $res_val3 = (int)$lpcn_number3 + 1;
            $run_doc = $lpcn_number1 . $lpcn_number2 . $res_val3;
        } else { //หลักสิบ
            $res_val3 = 0;
            $res_val2 = (int)$lpcn_number2 + 1;
            $run_doc = $lpcn_number1 . $res_val2 . $res_val3;
        }
    }
    $run_doc = "PT".$t_time_save_year.$run_doc;
} else {

    $run_doc = "001";
    $run_doc = "PT".$t_time_save_year.$run_doc;
}

$run_doc;
?>