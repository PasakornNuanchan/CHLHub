<?php
include '../../core/conn.php';
$arr = array();
$arr_suc = array();
$del_id = $_POST['del_id'];

$sql_query =
    "
            UPDATE
                `transport_booking`
            SET
                `status` = '1'
            WHERE
                ID = $del_id
            ";

if ($con->query($sql_query) != 1) {
    $arr_suc['st'] = '0';
} else {
    $arr_suc['st'] = '1';
}

$sql_query_driver = "
            UPDATE
                `transport_contact`
            SET
                `status` = '1'
            WHERE
                route_id = '$del_id'
";

if ($con->query($sql_query_driver) != 1) {
    $arr_suc['sta'] = '0';
} else {
    $arr_suc['sta'] = '1';
}

echo json_encode($arr_suc);