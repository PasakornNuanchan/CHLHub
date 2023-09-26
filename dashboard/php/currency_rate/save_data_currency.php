<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';

$data_save = $_POST['arr_data'];

foreach($data_save as $k => $v){

$usd_thb = isset($v['usd_thb']) ? $v['usd_thb'] : '';
$usd_rmb = isset($v['usd_rmb']) ? $v['usd_rmb'] : '';
$usd_yen = isset($v['usd_yen']) ? $v['usd_yen'] : '';
$thb_usd = isset($v['thb_usd']) ? $v['thb_usd'] : '';
$thb_rmb = isset($v['thb_rmb']) ? $v['thb_rmb'] : '';
$thb_yen = isset($v['thb_yen']) ? $v['thb_yen'] : '';
$rmb_usd = isset($v['rmb_usd']) ? $v['rmb_usd'] : '';
$rmb_thb = isset($v['rmb_thb']) ? $v['rmb_thb'] : '';
$rmb_yen = isset($v['rmb_yen']) ? $v['rmb_yen'] : '';
$yen_usd = isset($v['yen_usd']) ? $v['yen_usd'] : '';
$yen_thb = isset($v['yen_thb']) ? $v['yen_thb'] : '';
$yen_rmb = isset($v['yen_rmb']) ? $v['yen_rmb'] : '';
$start_date = isset($v['start_date']) ? $v['start_date'] : '';
$end_date = isset($v['end_date']) ? $v['end_date'] : '';

    $sql_query_data = "
    INSERT INTO `sys_rate_cur`(
        `start_date`,
        `end_date`,
        `create_by`,
        `create_datetime`,
        `usd_thb`,
        `usd_rmb`,
        `usd_yen`,
        `thb_usd`,
        `thb_rmb`,
        `thb_yen`,
        `rmb_usd`,
        `rmb_thb`,
        `rmb_yen`,
        `yen_usd`,
        `yen_thb`,
        `yen_rmb`
    )
    VALUES(
        '$start_date',
        '$end_date',
        '$data_user',
        '$t_time_save',
        '$usd_thb',
        '$usd_rmb',
        '$usd_yen',
        '$thb_usd',
        '$thb_rmb',
        '$thb_yen',
        '$rmb_usd',
        '$rmb_thb',
        '$rmb_yen',
        '$yen_usd',
        '$yen_thb',
        '$yen_rmb'
    )";
}


$result = $con->query($sql_query_data);
if ($result->num_rows == 0) {
    $arr_res = '1';
} else {
    $arr_res = '0';
}


echo json_encode(array('arr_res'=>$arr_res));

?>