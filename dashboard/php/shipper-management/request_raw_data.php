<?php
    include '../../core/conn.php';

    $shipper_number = $_POST['shipper_number'];

    $sql_request_raw_sup = "
        SELECT * FROM shipper WHERE ID = '$shipper_number'";

    $sql_request_raw_bank = "
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
      `shipper_id`
  FROM
      `shipper_bank`
  WHERE
    shipper_id = '$shipper_number'
    ";

    $result = $con->query($sql_request_raw_sup);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $sqrc = $row;
      }
    } else {
      $sqrc = "0 results";
    }

    $result = $con->query($sql_request_raw_bank);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $bank[] = $row;
      }
    } else {
      $bank = "0 results";
    }


      echo json_encode(array('sqrc'=>$sqrc,'bank'=>$bank));
?>