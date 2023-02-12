<?php
    include '../../core/conn.php';
    $arr = array();
    $job_number = $_POST['job_number'];
    
    $sql_supplier = "
    SELECT * FROM `transport_sup`";

    $sql_shipper = "
    SELECT ID, shipper_name, shipper_number FROM shipper;";

    $sql_shipment ="
    SELECT ID, st_number,st_name FROM shipment_term;";

    $sql_carrier ="
    SELECT ID, carrier_number, carrier_name FROM carrier;";

    $sql_area ="
    SELECT ID, area_number,location_name,country FROM area;";

    $sql_cargo ="
    SELECT ID, cargo_type_number ,cargo_type_name FROM cargo_type;";

    $sql_type_truck = "
    SELECT
    `ID`,
    `type_truck_number`,
    `truck_name`
FROM
    `type_truck`";

    $sql_container = "
    SELECT 
        `ID`,
        `container_type`,
        `cy`,
        `rtn`,
        `container_number`
    FROM container 
     WHERE job_number = '$job_number';";

$result = $con->query($sql_supplier);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $supplier[] = $row;
    }
} else {
    $supplier[] = "0 results";
}

$result = $con->query($sql_shipper);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $shipper[] = $row;
    }
} else {
    $shipper[] = "0 results";
}

$result = $con->query($sql_shipment);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $shipment[] = $row;
    }
} else {
    $shipment[] = "0 results";
}

$result = $con->query($sql_carrier);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $carrier[] = $row;
    }
} else {
    $carrier[] = "0 results";
}

$result = $con->query($sql_area);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $area[] = $row;
    }
} else {
    $area[] = "0 results";
}

$result = $con->query($sql_cargo);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cargo[] = $row;
    }
} else {
    $cargo[] = "0 results";
}

$result = $con->query($sql_type_truck);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $truck[] = $row;
    }
} else {
    $truck[] = "0 results";
}

$result = $con->query($sql_container);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $container[] = $row;
    }
} else {
    $container[] = "0 results";
}


  
    echo json_encode(array('supplier'=>$supplier,'shipper'=>$shipper,'shipment'=>$shipment,'carrier'=>$carrier,'area'=>$area,'cargo'=>$cargo,'truck'=>$truck,'container'=>$container))

?>