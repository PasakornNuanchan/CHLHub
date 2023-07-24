<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
include '../../core/con_path.php';

// $con->begin_transaction();
// $con->autocommit(FALSE);
// try {
    //print_r($_POST['cargo_desc']);

    // $err_msg = "";
    // $inst_st = "1";
    // $job_number = '0002';
    $val_id = $_POST['valid'];
    $job_number = $_POST['job_number'];
    $bk_no = $_POST['bk_no'];
    
    $shipper = $_POST['shipper'] ? $_POST['shipper'] : NULL ;
    $shipterm = $_POST['shipterm'] ? $_POST['shipterm'] : NULL;
    $remark = $_POST['remark'];
    $carrier = $_POST['carrier'] ? $_POST['carrier'] : NULL ;

    
    

    $port_recieve = $_POST['port_recieve'] ? $_POST['port_recieve'] : NULL;
    $port_load = $_POST['port_load'] ? $_POST['port_load'] : NULL ;
    $ts_port  = $_POST['ts_port'] ? $_POST['ts_port'] : NULL ;
    $port_delivery  = $_POST['port_delivery'] ? $_POST['port_delivery'] : NULL;

    $mother_vessel = $_POST['mother_vessel'];
    $mother_voy_no = $_POST['mother_voy_no'];
    $feeder_vessel = $_POST['feeder_vessel'];
    $feeder_voy_no = $_POST['feeder_voy_no'];
    $etd = $_POST['etd'] ? $_POST['etd'] : NULL;
    $eta = $_POST['eta'] ? $_POST['eta'] : NULL;

    $consignee = $_POST['consignee'] ? $_POST['consignee'] : NULL ;
    $container = $_POST['container'];
    $cargo_desc = $_POST['cargo_desc'];
    $hs_code = $_POST['hs_code'];
    $cargo_type = $_POST['cargo_type'];
    $cargo_qty = $_POST['cargo_qty'];
    $cargo_gw = $_POST['cargo_gw'];
    $cargo_vol = $_POST['cargo_vol'];
    $cargo_marks = $_POST['cargo_marks'];
    $represent = $_POST['represent'] ? $_POST['represent'] : NULL;

    $shipperr = $shipper == NULL ? "NULL" : "'".$_POST['shipper']."'";
    $shiptermm = $shipterm == NULL ? "NULL" : "'".$_POST['shipterm']."'";
    $carrierr = $carrier == NULL ? "NULL" : "'".$_POST['carrier']."'";
    $representt = $represent == NULL ? "NULL" : "'".$_POST['represent']."'";
    $consigneee = $consignee == NULL ? "NULL" : "'".$_POST['consignee']."'";
    $etdd = $etd == NULL ? "NULL" : "'".$_POST['etd']."'";
    $etaa = $eta == NULL ? "NULL" : "'".$_POST['eta']."'";
    $port_recievee = $port_recieve == NULL ? "NULL" : "'".$_POST['port_recieve']."'";
    $port_loadd = $port_load == NULL ? "NULL" : "'".$_POST['port_load']."'";
    $ts_portt = $ts_port == NULL ? "NULL" : "'".$_POST['ts_port']."'";
    $port_deliveryy = $port_delivery == NULL ? "NULL" : "'".$_POST['port_delivery']."'";

    $sql = "
    UPDATE
        `job_title`
    SET
        `job_number` = '$job_number',
        `consignee_number` = $consigneee,
        `booking_number` = '$bk_no',
        `shipper_number` = $shipperr,
        `st_number` = $shiptermm,
        `carrier_number` = $carrierr,
        `port_of_receipt_number` = $port_recievee,
        `port_of_loading_number` = $port_loadd,
        `ts_port_number` = $ts_portt,
        `port_of_delivery_number` = $port_deliveryy,
        `mother_vessel` = '$mother_vessel',
        `voy_no_mother` = '$mother_voy_no',
        `feeder_vessel` = '$feeder_vessel',
        `voy_no_feeder` = '$feeder_voy_no',
        `etd` = $etdd,
        `eta` = $etaa,
        `remark` = '$remark',
        `booking_agent` = $representt
    WHERE
        ID = $val_id
    ";
    // if ($con->query($sql) === TRUE) {

    // }

    
    // foreach ($container as $k => $v) {
    //     $cont_each = [];
    //     $type = $v['type'];
    //     $weight = $v['weight'];
    //     $soc = $v['soc'];
    //     $ow = $v['ow'];
    //     $cy = $v['cy'];
    //     $rtn = $v['rtn'];


    //     $sqlcontainer = "
    //     INSERT INTO `container`(
    //         `job_number`,
    //         `container_type`,
    //         `single_cnt`,
    //         `soc`,
    //         `ow`,
    //         `cy`,
    //         `rtn`
    //     )
    //     VALUES(
    //         '$job_number',
    //         '$type',
    //         '$weight',
    //         '$soc',
    //         '$ow',
    //         '$cy',
    //         '$rtn'
    //     ); ";

        
    //     if ($con->query($sqlcontainer) === TRUE) {
    //     }
    // }
    
      $sql_cargo = "
        UPDATE
            `container_information`
        SET
            
            `cargo` = '$cargo_desc',
            `hs_code` = '$hs_code',
            `cargo_type` = '$cargo_type',
            `quantity` = '$cargo_qty',
            `gw` = '$cargo_gw',
            `volume` = '$cargo_vol',
            `mark` = '$cargo_marks'
        WHERE
            `ref_job_id` = '$val_id'
        ";

    // if ($con->query($sql_cargo) === TRUE) {
        
    // }

    $status_bk = $con->query($sql);
    $status_cn = $con->query($sql_cargo);

    echo json_encode($status_cn,$status_cn);
    // $arr = array('res' => 'insert successful !!', 'st' => '1');
    // echo json_encode($arr);
//     $con->commit();
// } catch (\Exception $e) {
//     // this will show statement with error
//     $arr = array('res' => 'Insert Failed !!', 'st' => '0');
//     echo json_encode($arr);
//     $con->rollback();
//     throw $e;
// }

// if ($err_msg == "") {
//     $arr = array('res' => 'insert successful !!', 'st' => $inst_st);
//     echo json_encode($arr);
// } else {
//     $arr = array('res' => 'insert failed !!', 'st' => $inst_st, 'err' => $con->error, 'msg' => $err_msg);
//     echo json_encode($arr);
// }
// $con->close();
