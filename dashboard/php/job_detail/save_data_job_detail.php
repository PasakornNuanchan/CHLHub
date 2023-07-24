<?php
include '../../core/conn.php';

$data_job_detail = $_POST['arr_detail_save'];
$data_container = $_POST['arr_detail_container'];
$data_container_delete = $_POST['delete_data'];
$id_number = $_POST['id_number'];


    foreach($data_job_detail as $k => $v){
        $cargo_des = $v['cargo_des'];
        $cargo_type = $v['cargo_type'];
        $quantity = $v['quantity'];
        $gw = $v['gw'];
        $vol = $v['vol'];
        $remark_container = $v['remark_container'];
    

        $cargo_des = empty($cargo_des) ? NULL : $cargo_des;
        $cargo_type = empty($cargo_type) ? NULL : $cargo_type;
        $quantity = empty($quantity) ? "NULL" : "'".$quantity."'";
        $gw = empty($gw) ? "NULL" : "'".$gw."'";
        $vol = empty($vol) ? "NULL" : "'".$vol."'";
        $remark_container = empty($remark_container) ? NULL : $remark_container;
    

        // $cargo_des = isset($v['cargo_des']) ? $v['cargo_des'] : '';
        // $cargo_type = isset($v['cargo_type']) ? $v['cargo_type'] : '';
        // $quantity = isset($v['quantity']) ? $v['quantity'] : '';
        // $gw = isset($v['gw']) ? $v['gw'] : '';
        // $vol = isset($v['vol']) ? $v['vol'] : '';
        // $remark_container = isset($v['remark_container']) ? $v['remark_container'] : '';
    
    
        $sql_query_container ="
        UPDATE
            `container_information`
        SET
            `cargo` = '$cargo_des',
            `cargo_type` = '$cargo_type',
            `quantity` = $quantity,
            `gw` = $gw,
            `volume` = $vol,
            `mark` = '$remark_container'
        WHERE
            ref_job_id = '$id_number'
        ";

        $result = $con->query($sql_query_container);
        if ($result->num_rows == 0) {
            $arr_data_container_information = '1';
        } else {
            $arr_data_container_information = '0';
        }

    }
    
    foreach($data_job_detail as $k => $v){
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
        
        $query_save = "
        UPDATE
        `job_title`
        SET
            `job_number` = '$job_number',
            `consignee_number` = '$consignee',
            `booking_number` = '$booking_number',
            `shipper_number` = $shipper,
            `st_number` = $shipment,
            `mbl` = '$mbl',
            `hbl` = '$hbl',
            `inv` = '$inv',
            `carrier_number` = '$carrier',
            `port_of_receipt_number` = '$port_of_receipt',
            `port_of_loading_number` = '$port_of_loading',
            `ts_port_number` = '$ts_port',
            `port_of_delivery_number` = '$port_of_delivery',
            `mother_vessel` = '$mother',
            `feeder_vessel` = '$feeder',
            `etd` = $etd,
            `eta` = $eta,
            `remark` = '$remark',
            `booking_agent` = '$booking_agent'
        WHERE
            id = '$id_number'
            ";
        $result = $con->query($query_save);
        if ($result->num_rows == 0) {
            $arr_data_job_title = '1';
        } else {
            $arr_data_job_title = '0';
        }
    };



    if ($data_container_delete == '') {
        $arr_data_delete_container = '1';
    }else{
        foreach ($data_container_delete as $k => $v) {

            $raw_data_delete = isset($v['raw_data_delete']) ? $v['raw_data_delete'] : '';

            $sql_query = "
            DELETE
            FROM
                `container`
            WHERE
                ID = '$raw_data_delete'
            ";

            $result = $con->query($sql_query);
            if ($result->num_rows == 0) {
                $arr_data_delete_container = '1';
            } else {
                $arr_data_delete_container = '0';
            }
        }
    }
    
    foreach($data_container as $k => $v){
        $container_id = isset($v['container_id']) ? $v['container_id'] : '';
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

        if($container_id != ''){
             $sql_query_data_container = "
            UPDATE
            `container`
            SET
                `container_type` = $container_type,
                `single_cnt` = $cntw,
                `soc` = '$soc',
                `ow` = '$ow',
                `cy` = $cy,
                `rtn` = $rtn,
                `container_number` = '$container_number'
            WHERE
            ID = '$container_id'
            ";
        }else{
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
                '$id_number'
            )
            ";
        }
        $result = $con->query($sql_query_data_container);
        if ($result->num_rows == 0) {
            $arr_data_save_container = '1';
        } else {
            $arr_data_save_container = '0';
        }
    }

    echo json_encode(array('arr_data_container_information'=>$arr_data_container_information,
    'arr_data_job_title'=>$arr_data_job_title,
    'arr_data_delete_container'=>$arr_data_delete_container,
    'arr_data_save_container'=>$arr_data_save_container
    ))
?>
