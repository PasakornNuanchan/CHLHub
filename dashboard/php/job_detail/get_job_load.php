<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';

$sql_request_load = "
SELECT
    jt.ID,
    jt.job_number,
    jt.consignee_number,
    (SELECT consignee_name FROM consignee WHERE ID = jt.consignee_number) as consignee_name,
    jt.booking_number,
    jt.shipper_number,
    (SELECT shipper_name FROM shipper WHERE ID = jt.shipper_number) as shipper_name,
    jt.st_number,
    (SELECT st_name FROM shipment_term WHERE ID = jt.st_number) as st_name,
    jt.carrier_number,
    (SELECT carrier_name FROM carrier WHERE ID = jt.carrier_number) as carrier_name,
    jt.port_of_receipt_number,
    (SELECT concat(area.location_name,',',area.provice) FROM area WHERE ID = jt.port_of_receipt_number) as port_of_receipt_name,
    jt.port_of_loading_number,
    (SELECT concat(area.location_name,',',area.provice) FROM area WHERE ID = jt.port_of_loading_number) as port_of_loading_name,
    jt.ts_port_number,
    (SELECT concat(area.location_name,',',area.provice) FROM area WHERE ID = jt.ts_port_number) as ts_port_name,
    jt.port_of_discharge,
    (SELECT concat(area.location_name,',',area.provice) FROM area WHERE ID = jt.port_of_discharge) as port_of_discharge_name,
    jt.port_of_delivery_number,
    (SELECT concat(area.location_name,',',area.provice) FROM area WHERE ID = jt.port_of_delivery_number) as port_of_delivery_name,
    jt.remark,
    jt.create_date,
    jt.sale_support,
    jt.booking_agent,
    (SELECT agent_name_corp FROM agent_booking WHERE ID = jt.booking_agent) as booking_agent_name,
    jt.delivery_place,
    jt.final_destination,
    jt.notify_type,
    jt.notify_number,
    if(jt.notify_type = '1',(SELECT sp.shipper_name FROM shipper sp WHERE sp.ID = jt.notify_number),(SELECT c.consignee_name FROM consignee c WHERE c.ID = jt.notify_number)) as notify_name,
    jt.client_type,
    jt.client_number,
    if(jt.client_type = '1',(SELECT sp.shipper_name FROM shipper sp WHERE sp.ID = jt.client_number),(SELECT c.consignee_name FROM consignee c WHERE c.ID = jt.client_number)) as client_name
FROM
    job_title jt
LIMIT 50    
";


$result = $con->query($sql_request_load);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $load_data[] = $row;
  }
} else {
  $load_data = "0 results";
}

echo json_encode(array('load_data'=>$load_data))

?>