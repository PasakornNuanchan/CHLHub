<?php
include '../../core/conn.php';

$data_job_detail = $_POST['arr_detail_save'];
$data_container = $_POST['arr_detail_container'];
$data_container_delete = $_POST['delete_data'];
$id_number = $_POST['id_number'];
$arr_hbl = $_POST['arr_hbl'];

$arr_delete_hbl = $_POST['arr_delete_hbl'];

    

    foreach($arr_hbl as $k => $v){
        $hbl_data = isset($v['hbl_data']) ? $v['hbl_data'] : '';
        $id_hbl = isset($v['id_hbl']) ? $v['id_hbl'] : '';


        if($id_hbl != ''){
            $sql_query_hbl = "
            UPDATE
                `bl_title`
            SET
                `hbl` = '$hbl_data',
            WHERE
                `ref_job_id` = '$id_hbl'
            ";
        }else{
            $sql_query_hbl = "
            INSERT INTO `bl_title`(
                `ref_job_id`,
                `hbl`
            )
            VALUES(
                '$id_number',
                '$hbl_data'
                
            )
            ";
        }

        $result = $con->query($sql_query_hbl);
        if ($result->num_rows == 0) {
            $arr_hbl_data = '1';
        } else {
            $arr_hbl_data = '0';
        }
        
    }

    foreach($arr_delete_hbl as $k => $v){
        $data_id_hbl = isset($v['data_id_hbl']) ? $v['data_id_hbl'] : '';

        $sql_delete_bl_title = "DELETE FROM `bl_title` WHERE ID = '$data_id_hbl'";
        $sql_delete_bl_list = "DELETE FROM `bl_list` WHERE bl_title_id = '$data_id_hbl'";
        $sql_delete_fright_bl = "DELETE FROM `fright_bl` WHERE ref_row = '$data_id_hbl'";
        $result = $con->query($sql_delete_bl_title);
        $result = $con->query($sql_delete_bl_list);
        $result = $con->query($sql_delete_fright_bl);

    }




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
        $commodity = isset($v['commodity']) ? $v['commodity'] : '';
        $port_of_discharge = isset($v['port_of_discharge']) ? $v['port_of_discharge'] :'';

        //$notify = isset($v['notify']) ? $v['notify'] : '';
        
        $notify_value = isset($v['notify_value']) ? $v['notify_value'] : '';
        $notify_type = isset($v['notify_type']) ? $v['notify_type'] : '';
        $client_value = isset($v['client_value']) ? $v['client_value'] : '';
        $client_type = isset($v['client_type']) ? $v['client_type'] : '';

        $final_destination = isset($v['final_destination']) ? $v['final_destination'] : '';
        
        
        $eta = $v['eta'];
        $etd = $v['etd'];
        $shipper = $v['shipper'];
        $shipment = $v['shipment'];
        $cs_data_user = $v['cs_data_user'];
        $sale_data_user = $v['sale_data_user'];

        $eta = empty($eta) ? "NULL" : "'".$eta."'";
        $etd = empty($etd) ? "NULL" : "'".$etd."'";
        $shipper = empty($shipper) ? "NULL" : "'".$shipper."'";
        $shipment = empty($shipment) ? "NULL" : "'".$shipment."'";
        $cs_data_user = empty($cs_data_user) ? "NULL" : "'".$cs_data_user."'";
        $sale_data_user = empty($sale_data_user) ? "NULL" : "'".$sale_data_user."'";
        
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
            `inv` = '$inv',
            `carrier_number` = '$carrier',
            `port_of_receipt_number` = '$port_of_receipt',
            `port_of_loading_number` = '$port_of_loading',
            `ts_port_number` = '$ts_port',
            `port_of_discharge` = '$port_of_discharge',
            `port_of_delivery_number` = '$port_of_delivery',
            `mother_vessel` = '$mother',
            `feeder_vessel` = '$feeder',
            `etd` = $etd,
            `eta` = $eta,
            `remark` = '$remark',
            `booking_agent` = '$booking_agent',
            `sale_support` = $sale_data_user,
            `commodity` = '$commodity',
            `notify_type` = '$notify_type',
            `notify_number` = '$notify_value',
            `client_type` = '$client_type',
            `client_number` = '$client_value',
            `final_destination` = '$final_destination'
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

            $check_select = isset($v['check_select']) ? $v['check_select'] : '';
            $ref_job_id = isset($v['check_select']) ? $v['check_select'] : '';

            $sql_query = "
            DELETE
            FROM
                `container`
            WHERE
                container_type = '$check_select' AND ref_job_id = '$id_number'
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
        $id_container = isset($v['id_container']) ? $v['id_container'] : '';
        $container_type = isset($v['inp_container_type']) ? $v['inp_container_type'] : '';
        $cargo_des = isset($v['inp_cargo_des']) ? $v['inp_cargo_des'] : '';
        $container_number = isset($v['inp_container_number']) ? $v['inp_container_number'] : '';
        $package = isset($v['inp_package']) ? $v['inp_package'] : '';
        $packing = isset($v['inp_select_packing']) ? $v['inp_select_packing'] : '';
        $seal_number = isset($v['inp_seal_number']) ? $v['inp_seal_number'] : '';
        $remark = isset($v['inp_remark']) ? $v['inp_remark'] : '';

        $single_weight = $v['inp_single_weight'];
        $single_weight = empty($single_weight) ? "'0'" : "'".$single_weight."'";
        
        $gw = $v['inp_gw'];
        $gw = empty($gw) ? "'0'" : "'".$gw."'";

        $volume = $v['inp_volume'];
        $volume = empty($volume) ? "'0'" : "'".$volume."'";

        $cy = $v['inp_cy'];
        $cy = empty($cy) ? "NULL" : "'".$cy."'";

        $rtn = $v['inp_rtn'];
        $rtn = empty($rtn) ? "NULL" : "'".$rtn."'";


        if($id_container != ''){
             $sql_query_data_container = "
             UPDATE
             `container`
            SET
                `container_number` = '$container_number',
                `cargo_description` = '$cargo_des',
                `single_cnt` = $single_weight,
                `package` = '$package',
                `volume` = $volume,
                `gw` = $gw,
                `seal_number` = '$seal_number',
                `cy` = $cy,
                `rtn` = $rtn,
                `remark` = '$remark',
                `unit` = '$packing'
            WHERE
                ID = '$id_container'
            ";
        }else{

            $sql_query_data_container = "
            INSERT INTO `container`(
                `container_type`,
                `container_number`,
                `cargo_description`,
                `single_cnt`,
                `package`,
                `volume`,
                `gw`,
                `seal_number`,
                `cy`,
                `rtn`,
                `remark`,
                `ref_job_id`,
                `unit`
            )
            VALUES(
                '$container_type',
                '$container_number',
                '$cargo_des',
                $single_weight,
                '$package',
                $volume,
                $gw,
                '$seal_number',
                $cy,
                $rtn,
                '$remark',
                '$id_number',
                '$packing'
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
    'arr_data_save_container'=>$arr_data_save_container,
    'arr_hbl_data'=>$arr_hbl_data,
    ))
?>
