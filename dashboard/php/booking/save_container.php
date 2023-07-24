<?php
session_start();
include '../../core/conn.php';
require '../../function/auth/get_session.php';
include '../../core/con_path.php';
$container_arr = $_POST['container_arr'];


foreach ($container_arr as $k => $v) {
    $con_type = isset($v['con_type']) ? $v['con_type'] : '';
    $slw = isset($v['slw']) ? $v['slw'] : '';
    $soc = isset($v['ssoc']) ? $v['ssoc'] : '';
    $ow = isset($v['oow']) ? $v['oow'] : '';
    $cy_con = isset($v['cy']) ? $v['cy'] : NULL;
    $rtn_con = isset($v['rtn']) ? $v['rtn'] : NULL;
    $ref_job_id = isset($v['ref_job_id']) ? $v['ref_job_id'] : '';
    $attr_booking_container = isset($v['attr_booking_container']) ? $v['attr_booking_container'] : '';
    

    $cya = $cy_con == NULL ? "NULL" : "'".$v['cy']."'";
    $rtna = $rtn_con == NULL ? "NULL" : "'".$v['rtn']."'";
    

    if($attr_booking_container == ''){
        $sql = "
        INSERT INTO `container`(
            `ref_job_id`,
            `container_type`,
            `single_cnt`,
            `soc`,
            `ow`,
            `cy`,
            `rtn`
        )
        VALUES(
            '$ref_job_id',
            '$con_type',
            '$slw',
            '$soc',
            '$ow',
            $cya,
            $rtna
        )
        ";
        
    }else{
        $sql = "
        UPDATE
            `container`
        SET
            `container_type` = '$con_type',
            `single_cnt` = '$slw',
            `soc` = '$soc',
            `ow` = '$ow',
            `cy` = $cya,
            `rtn` = $rtna
        WHERE
            ID = '$attr_booking_container'
        ";
    }
    
    $status[] = $con->query($sql);
}

echo json_encode($status);
