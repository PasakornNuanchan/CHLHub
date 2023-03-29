<?php
    include '../../core/conn.php';

    $shipper_number = $_POST['shipper_number'];

    $sql_request_raw_sup = "
        SELECT * FROM shipper WHERE ID = $shipper_number";

    $result = $con->query($sql_request_raw_sup);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $sqrc = $row;
      }
    } else {
      $sqrc = "0 results";
    }


      echo json_encode(array('sqrc'=>$sqrc));
?>