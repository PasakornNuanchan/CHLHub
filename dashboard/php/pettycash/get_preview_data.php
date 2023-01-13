<?php
$petty_number = $_POST['petty_number'];
    include '../../core/conn.php';

    $sql_pct = "
    SELECT * FROM `petty_cash_title` as pct
    INNER JOIN user as u ON pct.request_by = u.user_number
    WHERE petty_cash_number = '$petty_number'
    ";


   $sql_pcd = "
    SELECT * FROM `petty_cash_detail` where `petty_cash_number` ='$petty_number'
    ";

    $result = $con -> query($sql_pct);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $pct = $row;
        }
      } else {
        $pct = "0 results";
      }

      $result = $con -> query($sql_pcd);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $pcd[] = $row;
        }
      } else {
        $pcd = "0 results";
      }

      echo json_encode(array('pcd'=>$pcd,'pct'=>$pct));




?>