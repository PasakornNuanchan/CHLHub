<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
include '../../core/con_path.php';

$data_detail_save = $_POST['arr_detail_save'];
$data_detail_container = $_POST['arr_detail_container'];



// save job title
foreach($data_detail_save as $k => $v){
    $job_number = isset($v['job_number']) ? $v['job_number'] : '';
    $booking_number = isset($v['booking_number']) ? $v['booking_number'] : '';
    $consignee = isset($v['consignee']) ? $v['consignee'] : '';
    
    $remark = isset($v['remark']) ? $v['remark'] : '';
    $carrier = isset($v['carrier']) ? $v['carrier'] : '';
    $port_of_receipt = isset($v['port_of_receipt']) ? $v['port_of_receipt'] : '';
    $port_of_loading = isset($v['port_of_loading']) ? $v['port_of_loading'] : '';
    $ts_port = isset($v['ts_port']) ? $v['ts_port'] : '';
    $port_of_delivery = isset($v['port_of_delivery']) ? $v['port_of_delivery'] : '';
    $mother = isset($v['mother']) ? $v['mother'] : '';
    $feeder = isset($v['feeder']) ? $v['feeder'] : '';
    $inv = isset($v['inv']) ? $v['inv'] : '';
    $mbl = isset($v['mbl']) ? $v['mbl'] : '';
    $hbl = isset($v['hbl']) ? $v['hbl'] : '';
    $booking_agent = isset($v['booking_agent']) ? $v['booking_agent'] : '';
    
    $eta = $v['eta'];
    $etd = $v['etd'];
    $shipper = $v['shipper'];
    $shipment = $v['shipment'];

    $eta = empty($eta) ? "NULL" : "'".$eta."'";
    $etd = empty($etd) ? "NULL" : "'".$etd."'";
    $shipper = empty($shipper) ? "NULL" : "'".$shipper."'";
    $shipment = empty($shipment) ? "NULL" : "'".$shipment."'";
    

    $sql_fetch_data_save = "
    INSERT INTO `job_title`(
        `job_number`,
        `consignee_number`,
        `booking_number`,
        `shipper_number`,
        `st_number`,
        `mbl`,
        `hbl`,
        `inv`,
        `carrier_number`,
        `port_of_receipt_number`,
        `port_of_loading_number`,
        `ts_port_number`,
        `port_of_delivery_number`,
        `mother_vessel`,
        `feeder_vessel`,
        `etd`,
        `eta`,
        `remark`,
        `create_date`,
        `last_save_by`,
        `booking_agent`
    )
    VALUES(
        '$job_number',
        '$consignee',
        '$booking_number',
        $shipper,
        $shipment,
        '$mbl',
        '$hbl',
        '$inv',
        '$carrier',
        '$port_of_receipt',
        '$port_of_loading',
        '$ts_port',
        '$port_of_delivery',
        '$mother',
        '$feeder',
        $etd,
        $eta,
        '$remark',
        '$t_time_save',
        '$data_user',
        '$booking_agent'
    )
    ";

    if ($con->query($sql_fetch_data_save) === TRUE) {
        $last_id = $con->insert_id;
        $res_in_job_title = '1';
    } else {
        $res_in_job_title = '0';
    }
}


//save container information
foreach($data_detail_save as $k => $v){
    
    $cargo_des = $v['cargo_des'];
    $cargo_type = $v['cargo_type'];
    $quantity = $v['quantity'];
    $gw = $v['gw'];
    $vol = $v['vol'];
    $remark_container = $v['remark_container'];

    $cargo_des = empty($cargo_des) ? "NULL" : $cargo_des;
    $cargo_type = empty($cargo_type) ? "NULL" : $cargo_type;
    $quantity = empty($quantity) ? "NULL" : "'".$quantity."'";
    $gw = empty($gw) ? "NULL" : "'".$gw."'";
    $vol = empty($vol) ? "NULL" : "'".$vol."'";
    $remark_container = empty($remark_container) ? "NULL" : $remark_container;

    $sql_query_container_information = "
    INSERT INTO `container_information`(
        `cargo`,
        `cargo_type`,
        `quantity`,
        `gw`,
        `volume`,
        `mark`,
        `ref_job_id`
    )
    VALUES(
        $cargo_des,
        $cargo_type,
        $quantity,
        $gw,
        $vol,
        $remark_container,
        '$last_id'
    )
    ";

    if ($con->query($sql_query_container_information) === TRUE) {
        $res_in_container_information = '1';
    } else {
        $res_in_container_information = '0';
    }

}

foreach($data_detail_container as $k => $v){
    $container_type = isset($v['container_type']) ? "'".$v['container_type']."'" : "NULL";
    $container_number = isset($v['container_number']) ? $v['container_number'] : '';

    $soc = isset($v['soc']) ? $v['soc'] : '';
    $ow = isset($v['ow']) ? $v['ow'] : '';
    $cy = isset($v['cy']) ? $v['cy'] : '';
    $rtn = isset($v['rtn']) ? $v['rtn'] : '';

    $cntw = $v['cntw'];
    $cntw = empty($cntw) ? "NULL" : "'".$cntw."'";
    
    $cy = $v['cy'];
    $cy = empty($cy) ? "NULL" : "'".$cy."'";

    $rtn = $v['rtn'];
    $rtn = empty($rtn) ? "NULL" : "'".$rtn."'";
    $sql_query_data_container = "
    INSERT INTO `container`(
        `container_type`,
        `single_cnt`,
        `soc`,
        `ow`,
        `cy`,
        `rtn`,
        `container_number`,
        `ref_job_id`   
    )
    VALUES(
        $container_type,
        $cntw,
        '$soc',
        '$ow',
        $cy,
        $rtn,
        '$container_number',
        '$last_id'
    )
    ";

    if ($con->query($sql_query_data_container) === TRUE) {
        $res_in_container = '1';
    } else {
        $res_in_container = '0';
    }

    
}

$sql_query_data_status = "
INSERT INTO `container`(
    `ref_job_id`
)
VALUES(
    '$last_id'
)
";

if ($con->query($sql_query_data_status) === TRUE) {
    $res_in_status = '1';
} else {
    $res_in_status = '0';
}

echo json_encode(array(
    'res_in_job_title'=>$res_in_job_title,
    'res_in_container_information'=>$res_in_container_information,
    'res_in_container'=>$res_in_container,
    'res_in_status'=>$res_in_status,
    'l_id'=>$last_id
));

?>