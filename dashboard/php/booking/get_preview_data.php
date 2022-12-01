<?php
$job_number = $_POST['job_number'];
    include '../../core/conn.php';


    $bk_no = $_POST['job_number'];
    $sql = "
        SELECT
            `ID`,
            `job_number`,
            `consignee_number`,
            `booking_number`,
            `shipper_number`,
            `st_number`,
            `mbl`,
            `hbl`,
            `inv`,
            `carrier_number`,
            `port_of_receipt_number`,
            `port_of_loading_number`,
            `ts_port_number`,
            `port_of_delivery_number`,
            `mother_vessel`,
            `voy_no_mother`,
            `feeder_vessel`,
            `voy_no_feeder`,
            `etd`,
            `eta`,
            `clearlance_date`,
            `delivery_date`,
            `check_document`,
            `enter_date`,
            `payment_date`,
            `pickup_DO_date`,
            `type_import_export`,
            `remark`,
            `create_date`,
            `status_job`
        FROM
            `job_title`
        WHERE
            job_number = '$job_number'
    ";


    $sql_continfo = "
    SELECT * FROM `container_information` where `job_number` ='$job_number'
    ";
    $result = $con -> query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo json_encode($row);
        }
      } else {
        echo "0 results";
      }
?>