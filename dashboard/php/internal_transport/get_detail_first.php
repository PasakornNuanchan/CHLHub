<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';

$sql_query_list = "
SELECT
    `ID`,
    `ref_job_id`,
    `description`,
    `pay_to`,
    `qty`,
    `price`,
    `vat`,
    `total`,
    `currency`,
    `receipt`,
    `remark`,
    `opertaion_date`,
    `truck_number`
FROM
    `transport_statement`
ORDER BY
    ID
DESC
LIMIT 100
";

$result = $con->query($sql_query_list);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $list[] = $row;
  }
} else {
  $list = "0 results";
}



echo json_encode(array('list'=>$list))
?>