<?php
    include '../../core/conn.php';
    $arr = array();
    $sql_supplier = "
    SELECT * FROM `transport_sup`
    ";
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

    $sql_type_truck ="
    SELECT ID,truck_name FROM type_truck";

    $sql_description_cash = "
    SELECT ID,billing_item_name
    FROM billing_description
    WHERE ID IN (20,21,22)";

    $sql_gover = "
    SELECT ID,name FROM Goverment_contact";
    
    $result = $con -> query($sql_supplier);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
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
        $type_truck[] = $row;
    }
} else {
    $type_truck[] = "0 results";
}

$result = $con->query($sql_description_cash);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $des_cash[] = $row;
    }
} else {
    $des_cash[] = "0 results";
}

$result = $con->query($sql_gover);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $gover[] = $row;
    }
} else {
    $gover = "0 results";
}

  
    echo json_encode(array('supplier'=>$supplier,'shipper'=>$shipper,'shipment'=>$shipment,'carrier'=>$carrier,'area'=>$area,'cargo'=>$cargo,'type_truck'=>$type_truck,'des_cash'=>$des_cash,'gover'=>$gover))
?>