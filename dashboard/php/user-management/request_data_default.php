<?php
    include '../../core/conn.php';

    $sql_request_department = "
    SELECT ID,department_name FROM `department`";

    $result = $con -> query($sql_request_department);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $srd[] = $row;
        }
      } else {
        $srd = "0 results";
      }


      echo json_encode(array('srd'=>$srd));
?>