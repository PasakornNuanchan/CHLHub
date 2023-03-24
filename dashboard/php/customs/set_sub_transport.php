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
      tb.sup_confirm,
      tb.type_truck,
      tb.remark
    FROM
        `transport_booking` as tb
    WHERE job_number = '$job_number' AND status = '0'"; 


$result = $con->query($sql_transport);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $tran[] = $row;
    $get_tran[] = $row['ID'];
  }
} else {
  $tran = "0 results";
}

if($tran != "0 results"){
$imp_set_tran_drive = implode(',', $get_tran);
$sql_tran_drive = "
      SELECT 
      tc.ID,
      tc.Driver_name,
      tc.phone_number,
      tc.container_id,
      tc.job_number,
      tc.route_id,
      c.container_number,
      c.seal_number
      FROM transport_contact as tc
      LEFT JOIN container as c ON tc.container_id = c.ID
      WHERE tc.route_id IN($imp_set_tran_drive) AND tc.status = '0'
      ";

      $result = $con->query($sql_tran_drive);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $transport_driver[] = $row;
        }

        foreach ($transport_driver as $k => $v) {
          $transport_driver_arr[$v['route_id']][] = $v;
        }
      } else {
        $transport_driver_arr = "0 results";
      }
  echo json_encode(array('tran'=>$tran,'transport_driver_arr'=>$transport_driver_arr));
}else{
  $transport_driver_arr = "0 results";
  echo json_encode(array('tran'=>$tran,'transport_driver_arr'=>$transport_driver_arr));
}
     




    
