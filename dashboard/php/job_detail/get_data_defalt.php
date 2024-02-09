<?php

include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';

$id_number = $_POST['id_number'];

$get_hbl = "SELECT ID,hbl FROM bl_title WHERE ref_job_id = '$id_number'";
$get_container = "SELECT c.ID,c.container_number,(SELECT concat(ct.container_sub_type,' (',ct.container_type_full_name,')') 
FROM container_type ct WHERE c.container_type = ct.container_type_name) as data_container FROM container c WHERE c.ref_job_id = '$id_number'";


$get_shipper = "SELECT ID,shipper_name FROM shipper ORDER BY shipper_name ASC";
$get_shipment = "SELECT ID,st_name FROM shipment_term";
$get_consignee = "SELECT `ID`,`consignee_name` FROM `consignee` ORDER BY consignee_name ASC";
$get_carrier = "SELECT ID,carrier_name FROM carrier ORDER BY carrier_name ASC" ;
$get_area = "SELECT ID,location_name,provice FROM area ORDER BY location_name ASC";
$get_cargo_type = "SELECT ID,cargo_type_name FROM cargo_type";
$get_agent = "SELECT ID,agent_name_corp FROM agent_booking ORDER BY agent_name_corp ASC";
$get_container_type = "SELECT ID,container_type_name,container_type_full_name FROM container_type";
$get_supplier = "SELECT ID,transport_sup_name FROM transport_sup";
$sql_truck = "SELECT ID,truck_name FROM `type_truck`";
$sql_shipping_user = "SELECT ID,first_name,last_name FROM user WHERE department_number = '3'";
$sql_cs_user = "SELECT ID,first_name,last_name FROM user";
$sql_sale_user = "SELECT ID,first_name,last_name FROM user WHERE department_number = '22'";
$sql_get_bill_to_ar = "
SELECT
    1 AS TYPE,
    `ID`,
    `consignee_name` as NAME
FROM
    `consignee`
";
$sql_get_billing_des_ar = "
SELECT
    bd.ID,
    bd.billing_number,
    bd.billing_code,
    bd.billing_item_name,
    bd.vat,
    bd.billing_item_name_cn,
    bd.type_billing
FROM
    billing_description bd
WHERE
    1
ORDER BY
	bd.billing_code";

$sql_get_billing_des = "
SELECT
    bd.ID,
    bd.billing_number,
    bd.billing_code,
    bd.billing_item_name,
    bd.vat,
    bd.billing_item_name_cn,
    bd.type_billing
FROM
    billing_description bd
WHERE
    1
ORDER BY
	bd.billing_code
";

$sql_get_bill_to = "
SELECT
    1 AS TYPE,
    `ID`,
    `name` AS NAME
FROM
    `Goverment_contact`
UNION
SELECT
    2 AS TYPE,
    `ID`,
    `carrier_name` AS NAME
FROM
    carrier
";


$sql_get_shipper_consignee = "
SELECT 1 as type_data , sp.ID as id_data ,sp.shipper_name as name_data FROM shipper sp 
UNION
SELECT 2 as type_data , c.ID as id_data ,c.consignee_name as name_data FROM consignee c
ORDER BY name_data ASC;

";


$sql_unit = "SELECT ID,name FROM `unit`";


$sql_pick_container = "
SELECT
	DISTINCT tb.pick_con_empty_address,
    tb.pick_con_empty_remark,
    tb.ggpick_con_empty_address
FROM
    transport_booking tb";
$sql_load_container = "
SELECT
	DISTINCT tb.pick_con_address,
    tb.pick_con_remark,
    tb.ggpick_con_address
FROM
    transport_booking tb";
$sql_delivery_container = "
SELECT
	DISTINCT tb.drop_con_address,
    tb.drop_con_remark,
    tb.ggdrop_con_address
FROM
    transport_booking tb";
$sql_return_container = "
SELECT
	DISTINCT tb.drop_con_empty_address,
    tb.drop_con_empty_remark,
    tb.ggdrop_con_empty_address
FROM
    transport_booking tb
";

$result = $con->query($sql_pick_container);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $address_pick_container[] = $row;
  }
} else {
  $address_pick_container = "0 results";
}

$result = $con->query($sql_load_container);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $address_load_container[] = $row;
  }
} else {
  $address_load_container = "0 results";
}

$result = $con->query($sql_delivery_container);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $address_delivery_container[] = $row;
  }
} else {
  $address_delivery_container = "0 results";
}

$result = $con->query($sql_return_container);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $address_return_container[] = $row;
  }
} else {
  $address_return_container = "0 results";
}





$result = $con->query($sql_unit);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $unit[] = $row;
  }
} else {
  $unit = "0 results";
}

$result = $con->query($sql_get_shipper_consignee);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $shipper_consignee[] = $row;
  }
} else {
  $shipper_consignee = "0 results";
}

$result = $con->query($sql_get_bill_to_ar);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $bill_to_ar[] = $row;
  }
} else {
  $bill_to_ar = "0 results";
}

$result = $con->query($sql_get_billing_des_ar);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $billing_des_ar[] = $row;
  }
} else {
  $billing_des_ar = "0 results";
}

$result = $con->query($sql_get_bill_to);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $billing_bill_to[] = $row;
  }
} else {
  $billing_bill_to = "0 results";
}

$result = $con->query($sql_get_billing_des);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $billing_des[] = $row;
  }
} else {
  $billing_des = "0 results";
}

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

$result = $con->query($sql_cs_user);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $cs_data[] = $row;
  }
} else {
  $cs_data = "0 results";
}

$result = $con->query($sql_sale_user);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $sale_data[]= $row;
  }
} else {
  $sale_data = "0 results";
}

$result = $con->query($get_hbl);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $hbl_select_transport[] = $row;
  }
} else {
  $hbl_select_transport = "0 results";
}

$result = $con->query($get_container);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $container_select_transport[] = $row;
  }
} else {
  $container_select_transport = "0 results";
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
    'shipping_user'=>$shipping_user,
    'cs_data'=>$cs_data,
    'sale_data'=>$sale_data,
    'billing_des'=>$billing_des,
    'billing_bill_to'=>$billing_bill_to,
    'billing_des_ar'=>$billing_des_ar,
    'bill_to_ar'=>$bill_to_ar,
    'unit'=>$unit,
    'shipper_consignee'=>$shipper_consignee,
    'address_pick_container'=>$address_pick_container,
    'address_load_container'=>$address_load_container,
    'address_delivery_container'=>$address_delivery_container,
    'address_return_container'=>$address_return_container,
    'hbl_select_transport'=>$hbl_select_transport,
    'container_select_transport'=>$container_select_transport,
  ));
