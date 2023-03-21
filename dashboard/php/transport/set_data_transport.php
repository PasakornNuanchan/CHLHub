<?php
$job_number = $_POST['job_number'];
    include '../../core/conn.php';
    
    $sql_transport = "
      SELECT
        tb.ID,
        tb.sup_number,
        tb.truck_quantity,
        tb.pick_con_empty_address,
        tb.pick_con_empty_remark,
        tb.pick_con_address,
        tb.pick_con_remark,
        tb.drop_con_address,
        tb.drop_con_remark,
        tb.drop_con_empty_address,
        tb.drop_con_empty_remark,
        tb.budget,
        tb.cur,
        tb.sent_line_datetime,
        tb.sup_confirm,
        tb.type_truck,
        tb.remark,
        ts.transport_sup_name,
        tt.truck_name
      FROM transport_booking as tb
      LEFT JOIN transport_sup as ts ON tb.sup_number = ts.transport_sup_number
      LEFT JOIN type_truck as tt ON tb.type_truck = tt.ID
      WHERE tb.job_number = '$job_number' AND status = '0'
      ORDER BY tb.ID ASC";

      $result = $con->query($sql_transport);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $tran[] = $row;
        }
      } else {
        $tran = "0 results";
      }
 
 
        

      echo json_encode(array('tran'=>$tran));
