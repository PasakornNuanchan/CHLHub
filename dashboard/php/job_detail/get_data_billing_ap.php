<?php

include '../../core/conn.php';

$id_number = $_POST['id_number'];
$sql_request_data_billing = "
SELECT
    bi.*,
    cb.first_name cbfn,
    cb.last_name cbln,
    cb.brunch cbb,
    ccb.first_name ccbfn,
    ccb.last_name ccbln,
    apb.first_name apbfn,
    apb.last_name apbln,
    lub.first_name lubfn,
    lub.last_name lubln
FROM
    billing bi
LEFT JOIN USER cb ON
    cb.ID = bi.create_by
LEFT JOIN USER ccb ON
    ccb.ID = bi.check_by
LEFT JOIN USER apb ON
    apb.ID = bi.action_paid_by
LEFT JOIN USER lub ON
    lub.ID = bi.last_update_by
WHERE
    bi.type = 'AP' AND bi.status = '0' AND ref_job_id = '$id_number'
";

$result = $con->query($sql_request_data_billing);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $get_data_ap[] = $row;
  }
} else {
  $get_data_ap = "0 results";
}

echo json_encode(array('get_data_ap'=>$get_data_ap))

?>