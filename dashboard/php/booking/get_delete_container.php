<?php

    include '../../core/conn.php';

    $job_number = $_POST['job_number'];

    $sql_container_sel_delete = "
    SELECT * FROM `container` WHERE ref_job_id = '$job_number'
    ";

    $result = $con -> query($sql_container_sel_delete);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $sql_sel_del[] = $row;
        }
      } else {
        $sql_sel_del = "data_error";
      }

      echo json_encode(array('sql_sel_del'=>$sql_sel_del));
