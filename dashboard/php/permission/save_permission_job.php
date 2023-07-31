<?php
include '../../core/conn.php';

$arr_save = $_POST['arr_save'];

foreach($arr_save as $k => $v){
    $department = isset($v['department']) ? $v['department'] : '';
    $job_detail = isset($v['job_detail']) ? $v['job_detail'] : '';
    $transport = isset($v['transport']) ? $v['transport'] : '';
    $reportcs = isset($v['reportcs']) ? $v['reportcs'] : '';
    $customs = isset($v['customs']) ? $v['customs'] : '';
    $billing = isset($v['billing']) ? $v['billing'] : '';
    $withdraw = isset($v['withdraw']) ? $v['withdraw'] : '';


    $sql_query_data_job ="
    UPDATE
        `permisson_job_detail`
    SET
        `job_detail` = '$job_detail',
        `transport` = '$transport',
        `reportcs` = '$reportcs',
        `customs` = '$customs',
        `billing` = '$billing',
        `withdraw` = '$withdraw'
    WHERE
        department = '$department'
    ";

    if ($con->query($sql_query_data_job) === TRUE) {
        $rest = '1';
    } else {
        $rest = '0';
    }
}

echo json_encode($rest)



?>