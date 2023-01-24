<?php
    include '../../core/conn.php';
    $job_number = $_POST['job_number'];
    $sql_ar = "
    SELECT 
      b.ID,
      bd.billing_number,
      bd.billing_item_name,
      c.consignee_number,
      c.consignee_name,
      b.payble,
      b.currency,
      b.qty,
      b.unit_price,
      b.amount,
      b.vat,
      b.amtinclvat,
      b.remark,
      b.check_status
    FROM `billing` b
      LEFT JOIN billing_description bd ON b.billing_description = bd.billing_number
      LEFT JOIN consignee c ON b.bill_to = c.consignee_number
    WHERE 
      job_number = '$job_number' and 
      type = 'AR'
    ";
    $sql_ap = "
    SELECT * FROM `billing` WHERE job_number = '$job_number' and type = 'AP'
    ";


  

    $result = $con -> query( $sql_ar);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $ar[] = $row;
        }
      } else {
        $ar = "0 results";
      }

      $result = $con -> query($sql_ap);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $ap[] = $row;
        }
      } else {
        $ap = "0 results";
      }

    

      echo json_encode(array('ap'=>$ap,'ar'=>$ar));




?>