<?php

require '../../core/conn.php';
// print_r($_POST);
$quotation_number = isset($_POST['data']) ? $_POST['data'] : '';
$sql = "
SELECT
    qt.quartation_number as 'title_number',
    qt.consignee_number as 'title_consignee_number',
    qt.term as 'title_term',
    qt.commodity as 'title_commodity',
    qt.type as 'title_type',
    qt.user_sale as 'title_user_sale',
    qt.status as 'title_status',
    
    r.carrier_number as 'r_number',
    r.pol as 'r_pol',
    r.pod as 'r_pod',
    r.container_type as 'r_container_type',
    r.price as 'r_price',
    r.currency as 'r_curr',
    
    qdt.type as 'truck_type',
    qdt.pickup as 'truck_pickup',
    qdt.dropoff as 'truck_drop_off',
    qdt.price as 'truck_price',
    qdt.currency as 'truck_curr',
    
    qds.description as 'sup_des',
    qds.type as 'qds_type',
    qds.price as 'qds_price',
    qds.currency as 'qds_curr',
    qds.remark as 'qds_remark'
FROM
    `quartation_title` as qt
    
    LEFT JOIN quartation_detail_base qdb on qdb.quartation_number = qt.quartation_number
    LEFT JOIN quotation_detail_trucking qdt on qdt.quotation_number = qt.quartation_number
    LEFT JOIN quotation_detail_supservice qds on qds.quotation_number = qt.quartation_number
	LEFT JOIN route r on qdb.base_service_route = r.route_number
WHERE
    qt.quartation_number = ?;
";

$stmt = $con->prepare($sql);
$stmt->bind_param("s", $quotation_number);
$stmt->execute();
$result = $stmt->get_result();

$result_title_array = array();
$result_detail_array = array();
$result_array = array();
while ($row = $result->fetch_assoc()) {
    $result_array[] = $row;
}
foreach ($result_array as $key => $v) {
    $result_title_array['quo_number'] = $v['title_number'];    
    $result_title_array['title_consignee_number'] = $v['title_consignee_number']; 
    $result_title_array['title_commodity'] = $v['title_commodity'];
    $result_title_array['title_status'] = $v['title_status'];
    $result_title_array['title_term'] = $v['title_term'];
    $result_title_array['title_type'] = $v['title_type'];
    $result_title_array['title_user_sale'] = $v['title_user_sale'];
    unset($v["title_number"]);
    unset($v["title_consignee_number"]);
    unset($v["title_commodity"]);
    unset($v["title_status"]);
    unset($v["title_term"]);
    unset($v["title_type"]);
    unset($v["title_user_sale"]);
    $result_detail_array[] = $v;
}



// print_r($result_array);
echo json_encode(array('title' => $result_title_array, 'detail' => $result_detail_array));




?>