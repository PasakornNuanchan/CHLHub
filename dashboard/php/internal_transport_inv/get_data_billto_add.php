<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';


$sql_description = "
SELECT
    `ID`,
    `description_name`
FROM
    `internal_transport_description`
";
// echo $sql_data_set;
$result = $con->query($sql_description);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $description[] = $row;
  }
} else {
  $description = "0 results";
}


echo json_encode(array('description'=>$description));
