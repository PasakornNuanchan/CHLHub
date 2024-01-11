<?php

include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';


$sql_department = "
SELECT `ID`, `department_name` FROM `department` WHERE 1
";

$result = $con->query($sql_department);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $department[] = $row;
  }
} else {
  $department = "0 results";
}

echo json_encode(array('department'=>$department))

?>