<?php

include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';

$id_number = $_POST['id_number'];
$sql_query_data_hbl = "
SELECT
    `ID`,
    `ref_job_id`,
    `hbl`
FROM
    `bl_title`
WHERE
    ref_job_id = '$id_number'
";

$result = $con->query($sql_query_data_hbl);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
    $hbl[] = $row;
    }
} else {
    $hbl = "0 results";
}

echo json_encode(array('hbl'=>$hbl));

?>