<?php
include '../../core/conn.php';

$sql_request_sale = "
    SELECT u.ID,u.first_name,u.last_name FROM user u WHERE u.department_number IN (22,17)
AND u.ID IN (40,41,43,50,47,15,14,77,78,79,80)
    ";

$result = $con->query($sql_request_sale);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $sale[] = $row;
  }
} else {
  $sale = "0 results";
}


echo json_encode(array('sale' => $sale));
