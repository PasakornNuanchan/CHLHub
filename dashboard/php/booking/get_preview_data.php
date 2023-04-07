<?php
$job_number = $_POST['job_number'];
    include '../../core/conn.php';


    $bk_no = $_POST['job_number'];
    $sql = "
    SELECT
    jt.ID,
    jt.job_number,
    jt.consignee_number,
    jt.booking_number,
    jt.shipper_number,
    jt.st_number,
    jt.mbl,
    jt.hbl,
    jt.inv,
    c.ID as ID_carrier,
    c.carrier_number,
    jt.port_of_receipt_number,
    jt.port_of_loading_number,
   jt.ts_port_number,
   jt.port_of_delivery_number,
   jt.mother_vessel,
   jt.voy_no_mother,
   jt.feeder_vessel,
    jt.voy_no_feeder,
    jt.etd,
    jt.eta,
    jt.clearlance_date,
    jt.delivery_date,
    jt.check_document,
    jt.enter_date,
    jt.payment_date,
    jt.pickup_DO_date,
    jt.type_import_export,
    jt.remark,
    jt.create_date,
    jt.status_job,
    jt.booking_agent
FROM `job_title` as jt
LEFT JOIN carrier as c ON jt.carrier_number = c.carrier_number
WHERE
            job_number = '$job_number'
    ";

    


    $sql_continfo = "
    SELECT 
      ci.cargo,
      ci.cargo_type,
      ci.quantity,
      ci.gw,
      ci.mark,
      ci.volume,
      hs.ID as hs
 FROM `container_information` as ci
    LEFT JOIN hs_code as hs ON ci.hs_code = hs.ID
    where `job_number` ='$job_number'
    ";

    $sql_container = "
    SELECT 
        ct.container_type_number,
        COUNT(c.container_type) as container_count,
        c.single_cnt,
        c.soc,
        c.ow
    FROM `container` as c
    LEFT JOIN container_type as ct ON c.container_type = ct.container_type_name
    WHERE 
        c.job_number ='$job_number'
    GROUP BY 
        c.container_type
";

    $result = $con -> query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $booking = $row;
        }
      } else {
        $booking = "0 results";
      }

      $result = $con -> query($sql_continfo);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $contain = $row;
        }
      } else {
        $contain = "0 results";
      }

      $result = $con -> query($sql_container);
      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
              $container_table[] = $row;
          }
        } else {
          $container_table[] = "0 results";
        }


      echo json_encode(array('booking'=>$booking,'contain'=>$contain,'container_table'=>$container_table));
