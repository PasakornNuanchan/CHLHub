<?php
$petty_number = $_POST['petty_number'];
    include '../../core/conn.php';

    $sql_pct = "
    SELECT * FROM `petty_cash_title` as pct
    INNER JOIN user as u ON pct.request_by = u.user_number
    WHERE petty_cash_number = '$petty_number'
    ";


   $sql_pcd = "
   SELECT * FROM petty_cash_detail as pcd
   INNER JOIN job_title as jt ON jt.job_number = pcd.job_number
   INNER JOIN consignee as c ON c.consignee_number = jt.consignee_number WHERE pcd.petty_cash_number ='$petty_number'
    ";

   $sql_count_des = "
   SELECT count(job_number)as c_qty FROM `petty_cash_detail` where `petty_cash_number` ='$petty_number'
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

      $result = $con -> query($sql_count_des);
      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $scd = $row;
          }
        } else {
          $scd = "0 results";
        }
  


      echo json_encode(array('pcd'=>$pcd,'pct'=>$pct,'scd'=>$scd));




?>