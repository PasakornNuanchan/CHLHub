<?php
$job_number = $_POST['job_number'];
    include '../../core/conn.php';

    $sql_ab = "
    SELECT * FROM agent_booking";

    $result = $con -> query($sql_ab);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $ab[] = $row;
        }
      } else {
        $ab = "0 results";
      }


      echo json_encode(array('ab'=>$ab));
?>