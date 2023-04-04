<?php

include '../../core/conn.php';

$job_number = $_POST['job_number'];



$sql_container_sel_delete = "
    DELETE FROM `container` WHERE job_number = '$job_number'
    ";


$result = $con->query($sql_container_sel_delete);
if ($result->num_rows == 0) {
      $arr_res = '1';
} else {
  $arr_res = '0';
}

echo json_encode(array('arr_res' => $arr_res));
