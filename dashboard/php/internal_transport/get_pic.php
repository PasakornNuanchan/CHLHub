<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';
$id_number = $_POST['id_number'];
$sql_query_list = "
SELECT
    `receipt`
FROM
    `transport_statement`
WHERE
  ID = '$id_number'
";

$result = $con->query($sql_query_list);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $picture[] = $row;
  }
} else {
  $picture = "0 results";
}



echo json_encode(array('picture'=>$picture))
?>