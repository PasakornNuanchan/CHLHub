<?php
    // print_r($_POST);
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
    include '../../core/conn.php';

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
        `t/s_port_number`,
        `port_of_delivery_number`,
        `mother_vessel`,
        `voy_no_mother`,
        `feeder_vessel`,
        `voy_no_feeder`,
        `ETD`,
        `ETA`
    ) VALUES (
        '0001',
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
 
    );
    
    ";

    if ($con->query($sql) === TRUE) {
        echo json_encode(array('res' => 'insert succussfully !!'));
    } else {
        echo json_encode(array('res' => 'insert fail !!'));
    }
?>