<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
include '../../core/con_path.php';

$arr = array();
$arr_suc = array();
$arr_detail = $_POST['arr_detail'];

foreach ($arr_detail as $k => $v) {
         $inv = isset($v['inv']) ? $v['inv'] : '';
         $mbl = isset($v['mbl']) ? $v['mbl'] : '';
         $hbl = isset($v['hbl']) ? $v['hbl'] : '';
         $etd = isset($v['etd']) ? $v['etd'] : '';
         $eta = isset($v['eta']) ? $v['eta'] : '';
         $mother = isset($v['mother']) ? $v['mother'] : '';
         $motherv = isset($v['motherv']) ? $v['motherv'] : '';
         $feeder = isset($v['feeder']) ? $v['feeder'] : '';
         $feederv = isset($v['feederv']) ? $v['feederv'] : '';
         $job_number = isset($v['job_number']) ? $v['job_number'] : '';

         
        $sql_sv_detail = "
        UPDATE
            `job_title`
        SET
            `mbl` = '$mbl',
            `hbl` = '$hbl',
            `inv` = '$inv',
            `mother_vessel` = '$mother',
            `voy_no_mother` = '$motherv',
            `feeder_vessel` = '$feeder',
            `voy_no_feeder` = '$feederv',
            `etd` = '$etd',
            `eta` = '$eta'
        WHERE
            ID = '$job_number'
        ";


        if($con->query($sql_sv_detail) != 1){
            $arr_suc['st'] = '0';
        } else {
            $arr_suc['st'] = '1';
        }
}

echo json_encode($arr_suc);

