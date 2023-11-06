<?php

include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';

$sql_query_data_supplier = "
SELECT
    `ID`,
    `transport_sup_name`
FROM
    `transport_sup`
WHERE
    1
";

$result = $con->query($sql_query_data_supplier);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
    $supplier[] = $row;
    }
} else {
    $supplier = "0 results";
}


echo json_encode(array('supplier'=>$supplier));

?>