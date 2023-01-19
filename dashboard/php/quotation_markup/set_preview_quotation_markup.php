<?php

require '../../core/conn.php';
// print_r($_POST);
$quotation_number = isset($_POST['data']) ? $_POST['data'] : '';

//title
$sql = "
SELECT
    qt.`ID`,
    qt.quartation_number as 'title_number',
    qt.consignee_number as 'title_consignee_number',
    qt.term as 'title_term',
    qt.commodity as 'title_commodity',
    qt.type as 'title_type',
    qt.user_sale as 'title_user_sale',
    qt.status as 'title_status'
FROM
    `quartation_title` as qt
WHERE
    qt.quartation_number = ?;
";

$stmt = $con->prepare($sql);
$stmt->bind_param("s", $quotation_number);
$stmt->execute();
$result = $stmt->get_result();

//base
$sql_base = "
    SELECT DISTINCT
        qdb.`ID`,
        r.carrier_number as 'r_number',
        cr.carrier_name as 'r_carrier_name',
        r.pol as 'r_pol',
        arl.location_name as 'locateL',
        r.pod as 'r_pod',
        ard.location_name as 'locateD',
        r.container_type as 'r_container_type',
        r.price as 'r_price',
        (qdb.qty*qdb.unit_price) as 'price_qty',
        r.currency as 'r_curr'
    FROM
        `quartation_detail_base` as qdb
        LEFT JOIN route r on qdb.base_service_route = r.route_number
        INNER JOIN area arl on arl.area_number = r.pol
        INNER JOIN area ard on ard.area_number = r.pod
        LEFT JOIN carrier cr on cr.carrier_number = r.carrier_number 
    WHERE 1 AND
        qdb.quartation_number = ?;
";
$stmt_base = $con->prepare($sql_base);
$stmt_base->bind_param("s", $quotation_number);
$stmt_base->execute();
$result_base = $stmt_base->get_result();

//truck
$sql_truck = "
    SELECT
        `ID`,
        `quotation_number`,
        `type`,
        `pickup`,
        `dropoff`,
        `price`,
        `currency`
    FROM
        `quotation_detail_trucking` qdt
    WHERE
        1 AND `quotation_number` = ?
";
$stmt_truck = $con->prepare($sql_truck);
$stmt_truck->bind_param("s", $quotation_number);
$stmt_truck->execute();
$result_truck = $stmt_truck->get_result();

//sup_service
$sql_sup = "
    SELECT
        qds.`ID`,
        qss.description,
        qds.`quotation_number`,
        qds.`type`,
        qds.`price`,
        qds.`currency`,
        qds.`remark`
    FROM
        `quotation_detail_supservice` qds 
        LEFT JOIN quotation_sup_service qss on qss.ID = qds.description
    WHERE
        1 AND `quotation_number` = ?
";
$stmt_sup = $con->prepare($sql_sup);
$stmt_sup->bind_param("s", $quotation_number);
$stmt_sup->execute();
$result_sup = $stmt_sup->get_result();


$result_title_array = array();
$result_base_array = array();
$result_truck_array = array();
$result_sup_array = array();
$result_array = array();
while ($row = $result->fetch_assoc()) {
    $result_title_array = $row;
}
while ($row = $result_base->fetch_assoc()) {
    $result_base_array[] = $row;
}
while ($row = $result_truck->fetch_assoc()) {
    $result_truck_array[] = $row;
}
while ($row = $result_sup->fetch_assoc()) {
    $result_sup_array[] = $row;
}




// print_r($result_array);
echo json_encode(array('title' => $result_title_array, 'base' => $result_base_array, 'truck' => $result_truck_array, 'sup_service' => $result_sup_array));




?>