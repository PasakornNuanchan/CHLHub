<?php
    include '../../core/conn.php';

    $suptransport_number = $_POST['suptransport_number'];

    $sql_request_raw_sup = "
        SELECT * FROM transport_sup WHERE ID = $suptransport_number";
    $sql_request_raw_sup_bank = "
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
      `tax`,
      `commercial_number`,
      `transport_sup_id`
  FROM
      `transport_sub_bank`
  WHERE
      transport_sup_id = '$suptransport_number'
    ";
    $result = $con->query($sql_request_raw_sup);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $sqrc = $row;
      }
    } else {
      $sqrc = "0 results";
    }

    $result = $con->query($sql_request_raw_sup_bank);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $bank[] = $row;
      }
    } else {
      $bank = "0 results";
    }


      echo json_encode(array('sqrc'=>$sqrc,'bank'=>$bank));
?>