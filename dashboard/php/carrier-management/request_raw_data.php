<?php
    include '../../core/conn.php';

    $carrier_number = $_POST['carrier_number'];

    $sql_request_raw_carrier = "
        SELECT * FROM carrier WHERE ID = $carrier_number";

    $result = $con->query($sql_request_raw_carrier);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $sqrc = $row;
      }
    } else {
      $sqrc = "0 results";
    }


      echo json_encode(array('sqrc'=>$sqrc));
?>