<?php
    include '../../core/conn.php';
$con->begin_transaction();
$con->autocommit(FALSE);
try {




    // print_r($_POST);
    $err_msg = "";
    $inst_st = "1";
    $job_number = '0002';
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



    $sql = '';
    $sql = "
    INSERT INTO `job_title`(
        `job_number`,
        `booking_number`,
        `shipper_number`,
        `st_number`,
        `remark`,
        `carrier_number`,
        `port_of_receipt_number`,
        `port_of_loading_number`,
        `ts_port_number`,
        `port_of_delivery_number`,
        `mother_vessel`,
        `voy_no_mother`,
        `feeder_vessel`,
        `voy_no_feeder`,
        `ETD`,
        `ETA`
    ) VALUES (
        '$job_number',
        '$bk_no',
        '$shipper',
        '$shipterm',
        '$remark',
        '$carrier',
        '$port_recieve',
        '$port_load',
        '$ts_port',
        '$port_delivery',
        '$mother_vessel',
        '$mother_voy_no',
        '$feeder_vessel',
        '$feeder_voy_no',
        '$etd',
        '$eta'
 
    ); ";
    if ($con->query($sql) === TRUE) {
    } 
    foreach ($container as $k => $v) {
        $cont_each = [];
        $type = $v['type'];
        $weight = $v['weight'];
        $soc = $v['soc'];
        $ow = $v['ow'];
        $cy = $v['cy'];
        $rtn = $v['rtn'];


        $sqlcontainer = "
        INSERT INTO `container`(
            `job_nubmer`,
            `container_type`,
            `single_cnt`,
            `soc`,
            `ow`,
            `cy`,
            `rtn`
        )
        VALUES(
            '$job_number',
            '$type',
            '$weight',
            '$soc',
            '$ow',
            '$cy',
            '$rtn'
        ); ";
        if ($con->query($sqlcontainer) === TRUE) {
        } 
    }
    $sql_cargo = "
        INSERT INTO `container_information`(
            `job_number`,
            `cargo`,
            `hs_code`,
            `cargo_type`,
            `quantity`,
            `gw`,
            `volume`,
            `mark`
        )
        VALUES(
            '$job_number',
            '$cargo_desc',
            '$hs_code',
            '$cargo_type',
            '$cargo_qty',
            '$cargo_gw',
            '$cargo_vol',
            '$cargo_marks'
        )
    ";

    if ($con->query($sql_cargo) === TRUE) {
    } 
    $arr = array('res' => 'insert successful !!', 'st' => '1');
    echo json_encode($arr);
    $con->commit();

} catch (\Exception $e) {
    // this will show statement with error
    $arr = array('res' => 'Insert Failed !!', 'st' => '0');
    echo json_encode($arr);
    $con->rollback();
    throw $e;
}

// if ($err_msg == "") {
//     $arr = array('res' => 'insert successful !!', 'st' => $inst_st);
//     echo json_encode($arr);
// } else {
//     $arr = array('res' => 'insert failed !!', 'st' => $inst_st, 'err' => $con->error, 'msg' => $err_msg);
//     echo json_encode($arr);
// }
$con->close();
