<?php
    include '../../core/conn.php';

    $consignee_number = $_POST['consignee_number'];

    $sql_request_raw_consignee = "
        SELECT * FROM consignee WHERE ID = $consignee_number";

    $sql_reques_bank_raw_consignee = "
      SELECT 
        `ID`,
        `bank_abb`,
        `company_name`,
        `company_address`,
        `bank_number`,
        `bank_account`,
        `bank_swift_code`,
        `bank_code`,
        `country`,
        `tax_number`,
        `commercial_number`,
        `consignee_id`
          FROM consignee_bank WHERE consignee_id = '$consignee_number'
    ";

    $result = $con->query($sql_request_raw_consignee);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $sqrc = $row;
      }
    } else {
      $sqrc = "0 results";
    }

    $result = $con->query($sql_reques_bank_raw_consignee);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $bank[] = $row;
      }
    } else {
      $bank = "0 results";
    }


      echo json_encode(array('sqrc'=>$sqrc,'bank'=>$bank));
?>