<?php

include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';

$id_number = $_POST['id_number'];
$sql_query_data_consignee = "
SELECT 
jt.consignee_number,
c.consignee_name,
c.address,
c.tax
FROM job_title jt 
LEFT JOIN consignee c ON c.ID = jt.consignee_number
WHERE jt.ID ='$id_number'
";

$result = $con->query($sql_query_data_consignee);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
    $consingee[] = $row;
    }
} else {
    $consingee = "0 results";
}

echo json_encode(array('consingee'=>$consingee));

?>