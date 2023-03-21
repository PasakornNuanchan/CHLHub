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
      IF(b.bill_to_type = '1',cr.carrier_name,ts.transport_sup_name) as 'bill_to_name',
      b.bill_to,
      b.bill_to_type,
      b.payble,
      b.currency,
      b.qty,
      b.unit_price,
      b.amount,
      b.vat,
      b.amtinclvat,
      b.remark,
      b.check_by,
      b.action_paid_by
    FROM `billing` b
      LEFT JOIN billing_description bd ON b.billing_description = bd.billing_number
      LEFT JOIN consignee c ON b.bill_to = c.consignee_number
      LEFT JOIN transport_sup ts ON ts.ID = b.bill_to and b.bill_to_type = '2'
      LEFT JOIN carrier cr ON cr.ID = b.bill_to and b.bill_to_type = '1'
    WHERE 
      job_number = '$job_number' and 
      type = 'AP' and
      status = '0'
    ORDER BY
      b.ID ASC
    ";
    $result = $con -> query( $sql_ar);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $ap[] = $row;
        }
      } else {
        $ap = "0 results";
      }
      echo json_encode(array('ap'=>$ap));
