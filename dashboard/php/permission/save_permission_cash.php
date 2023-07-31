<?php
include '../../core/conn.php';

$arr_save = $_POST['arr_save'];

foreach($arr_save as $k => $v){
    $inp_select_department_cash = isset($v['inp_select_department_cash']) ? $v['inp_select_department_cash'] : '';
    $inp_payble = isset($v['inp_payble']) ? $v['inp_payble'] : '';
    $inp_advance = isset($v['inp_advance']) ? $v['inp_advance'] : '';
    $inp_petty_cash_request = isset($v['inp_petty_cash_request']) ? $v['inp_petty_cash_request'] : '';
    $inp_reutn_petty_cash = isset($v['inp_reutn_petty_cash']) ? $v['inp_reutn_petty_cash'] : '';
    
    $sql_query_data_cash ="
    UPDATE
    `permission_cash`
SET
    `payble` = '$inp_payble',
    `advance` = '$inp_advance',
    `pettycash` = '$inp_petty_cash_request',
    `returnpettycash` = '$inp_reutn_petty_cash'
WHERE
    department = '$inp_select_department_cash'
    ";

    if ($con->query($sql_query_data_cash) === TRUE) {
        $rest = '1';
    } else {
        $rest = '0';
    }
}

echo json_encode($rest)



?>