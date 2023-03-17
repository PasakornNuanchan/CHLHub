<?php
$petty_number = $_POST['petty_number'];
    include '../../core/conn.php';
    $sql_pct = "
    SELECT act.*,trpc.*,
req.first_name as freq,
req.last_name as lreq FROM petty_cash_title as act 
LEFT JOIN transac_recript_petty_cash as trpc ON act.petty_cash_number = trpc.doc_number
LEFT JOIN user as req ON act.request_by = req.user_number
WHERE act.petty_cash_number = '$petty_number' 
    ";

   $sql_pcd = "
   SELECT 
   pcd.ID,
   c.consignee_name,
   pcd.job_number,
   pcd.amount,
   pcd.currency 
   FROM petty_cash_detail as pcd
   INNER JOIN job_title as jt ON jt.job_number = pcd.job_number
   INNER JOIN consignee as c ON c.consignee_number = jt.consignee_number WHERE pcd.petty_cash_number ='$petty_number'
    ";

   $sql_count_des = "
   SELECT COUNT(job_number) as c_qty FROM `petty_cash_detail` WHERE petty_cash_number = '$petty_number'
    ";

    $job_number = 0;

  $sql_tranfer = "
  SELECT trpc.paid_date_time,u.first_name,u.last_name FROM `transac_recript_petty_cash` as trpc 
  LEFT JOIN user as u ON trpc.tranfer_by = u.user_number WHERE trpc.doc_number = '$petty_number'
  ";
 

    $result = $con -> query($sql_tranfer);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $pdt[] = $row['paid_date_time'];
          $name[] = $row['first_name']." ".$row['last_name'];

        } 
      } else {
        $pct = "0 results";
      }
      $imp_pdt = implode(',',$pdt);
      $imp_name = implode(',',$name);
    
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
            $pcdjn[] = $row['job_number'];
            $pcdjn2[] = $row['ID'];
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
  
      $pcn_id = implode(',' , $pcdjn2);
      $imp_set = implode(',' , $pcdjn);
     $sql_pcdr = "
      SELECT cp.*,bd.billing_item_name FROM Cash_payment as cp INNER JOIN billing_description as bd on cp.description = bd.ID 
      WHERE cp.type = 'Petty Cash' AND cp.job_number IN($imp_set) AND cp.ID_petty_cash IN ($pcn_id) AND cp.status IN ('0','2')";
      
      $result = $con -> query($sql_pcdr);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $dtpc[] = $row;
        }
      } else {
        $dtpc = "0 results";
      }

      foreach ($dtpc as $k => $v) {
        $dtpc_arr[$v['job_number']][] = $v;
      }
     echo json_encode(array('pcd'=>$pcd,'pct'=>$pct,'scd'=>$scd,'dtpc'=>$dtpc_arr,'imp_set'=>$imp_set,'$pcdjn'=>$pcdjn,'pdt'=>$imp_pdt,'name'=>$imp_name));
    




?>