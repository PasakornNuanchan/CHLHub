<?php
    include '../../core/conn.php';

    $consignee_number = $_POST['consignee_number'];

    $sql_request_raw_consignee = "
        SELECT * FROM consignee WHERE ID = $consignee_number";

    $result = $con->query($sql_request_raw_consignee);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $sqrc = $row;
      }
    } else {
      $sqrc = "0 results";
    }


      echo json_encode(array('sqrc'=>$sqrc));
?>