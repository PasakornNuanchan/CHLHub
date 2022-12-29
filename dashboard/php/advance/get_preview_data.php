<?php
$advance_number = $_POST['advance_number'];
    include '../../core/conn.php';

    $sql_pct = "
    SELECT * FROM `advance_cash_title` as act
    INNER JOIN user as u ON act.request_by = u.user_number
    WHERE advance_cash_number = '$advance_number'
    ";


   $sql_pcd = "
    SELECT * FROM `advance_cash_detail` where `advance_cash_number` ='$advance_number'
    ";

    $result = $con -> query($sql_pct);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $act = $row;
        }
      } else {
        $act = "0 results";
      }

      $result = $con -> query($sql_pcd);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $acd[] = $row;
        }
      } else {
        $acd = "0 results";
      }

      echo json_encode(array('acd'=>$acd,'act'=>$act));




?>