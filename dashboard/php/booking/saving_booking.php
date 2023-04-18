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
    
    $shipper = $_POST['shipper'];
    $shipterm = $_POST['shipterm'];
    $remark = $_POST['remark'];
    $carrier = $_POST['carrier'];
    $port_recieve = $_POST['port_recieve'];
    $port_load = $_POST['port_load'];
    $ts_port  = $_POST['ts_port'];
    $port_delivery  = $_POST['port_delivery'];
    $mother_vessel = $_POST['mother_vessel'];
    $mother_voy_no = $_POST['mother_voy_no'];
    $feeder_vessel = $_POST['feeder_vessel'];
    $feeder_voy_no = $_POST['feeder_voy_no'];
    $etd = $_POST['etd'];
    $eta = $_POST['eta'];

    $container = $_POST['container'];
    $cargo_desc = $_POST['cargo_desc'];
    $hs_code = $_POST['hs_code'];
    $cargo_type = $_POST['cargo_type'];
    $cargo_qty = $_POST['cargo_qty'];
    $cargo_gw = $_POST['cargo_gw'];
    $cargo_vol = $_POST['cargo_vol'];
    $cargo_marks = $_POST['cargo_marks'];
    $represent = $_POST['represent'];
    $consignee = $_POST['consignee'];

     $sql = "
    UPDATE
        `job_title`
    SET
        `job_number` = '$job_number',
        `consignee_number` = '$consignee',
        `booking_number` = '$bk_no',
        `shipper_number` = '$shipper',
        `st_number` = '$shipterm',
        `carrier_number` = '$carrier',
        `port_of_receipt_number` = '$port_recieve',
        `port_of_loading_number` = '$port_load',
        `ts_port_number` = '$ts_port',
        `port_of_delivery_number` = '$port_delivery',
        `mother_vessel` = '$mother_vessel',
        `voy_no_mother` = '$mother_voy_no',
        `feeder_vessel` = '$feeder_vessel',
        `voy_no_feeder` = '$feeder_voy_no',
        `etd` = '$etd',
        `eta` = '$eta',
        `remark` = '$remark',
        `booking_agent` = '$represent'
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
            `job_number` = '$job_number'
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
