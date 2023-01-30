<?php
    include '../../core/conn.php';
    $job_number = $_POST['job_number'];
    $sql_ap = "
    SELECT * FROM `billing` WHERE job_number = '$job_number' and type = 'AP'
    ";
      $result = $con -> query($sql_ap);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $ap[] = $row;
        }
      } else {
        $ap = "0 results";
      }
      echo json_encode(array('ap'=>$ap));
