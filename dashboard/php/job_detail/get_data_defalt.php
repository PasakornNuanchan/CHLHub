<?php

include '../../core/conn.php';

$get_shipper = "SELECT ID,shipper_name FROM shipper";
$get_shipment = "SELECT ID,st_name FROM shipment_term";
$get_consignee = "SELECT `ID`,`consignee_name` FROM `consignee`";
$get_carrier = "SELECT ID,carrier_name FROM carrier";
$get_area = "SELECT ID,location_name,provice FROM area";
$get_cargo_type = "SELECT ID,cargo_type_name FROM cargo_type";
$get_agent = "SELECT ID,agent_name_corp FROM agent_booking";
$get_container_type = "SELECT ID,container_type_name,container_type_full_name FROM container_type";
$get_supplier = "SELECT ID,transport_sup_name FROM transport_sup";
$sql_truck = "SELECT ID,truck_name FROM `type_truck`";
$sql_shipping_user = "SELECT ID,first_name,last_name FROM user WHERE department_number = '3'";


$result = $con->query($get_shipper);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $shipper_data[] = $row;
  }
} else {
  $shipper_data = "0 results";
}

$result = $con->query($get_shipment);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $shipment_data[]= $row;
  }
} else {
  $shipment_data = "0 results";
}

$result = $con->query($get_consignee);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $consginee_data[] = $row;
  }
} else {
  $consginee_data = "0 results";
}

$result = $con->query($get_carrier);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $carrier_data[] = $row;
  }
} else {
  $carrier_data = "0 results";
}

$result = $con->query($get_area);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $area_data[] = $row;
  }
} else {
  $area_data = "0 results";
}

$result = $con->query($get_cargo_type);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $cargo_data[] = $row;
  }
} else {
  $cargo_data = "0 results";
}

$result = $con->query($get_agent);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $agent_data[] = $row;
  }
} else {
  $agent_data = "0 results";
}

$result = $con->query($get_container_type);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $container_type_data[] = $row;
  }
} else {
  $container_type_data = "0 results";
}

$result = $con->query($get_supplier);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $supplier_data[] = $row;
  }
} else {
  $supplier_data = "0 results";
}

$result = $con->query($sql_truck);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $truck_data[] = $row;
  }
} else {
  $truck_data = "0 results";
}

$result = $con->query($sql_shipping_user);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $shipping_user[] = $row;
  }
} else {
  $shipping_user = "0 results";
}


echo json_encode(array(
    'shipper_data'=>$shipper_data,
    'shipment_data'=>$shipment_data,
    'consginee_data'=>$consginee_data,
    'carrier_data'=>$carrier_data,
    'area_data'=>$area_data,
    'cargo_data'=>$cargo_data,
    'agent_data'=>$agent_data,
    'container_type_data'=>$container_type_data,
    'supplier_data'=>$supplier_data,
    'truck_data'=>$truck_data,
    'shipping_user'=>$shipping_user));

?>