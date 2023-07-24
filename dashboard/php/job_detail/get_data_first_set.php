<?php
include '../../core/conn.php';

$data_id = $_POST['data'];

$job_title_data = "
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
    `feeder_vessel`,
    `etd`,
    `eta`,
    `remark`,
    `booking_agent`
FROM
    `job_title`
WHERE
    ID = '$data_id'
";

$container_information_data = "
SELECT
    `ID`,
    `cargo`,
    `cargo_type`,
    `quantity`,
    `gw`,
    `volume`,
    `mark`
FROM
    `container_information`
WHERE
    ref_job_id = '$data_id'
";

$container_data = "
SELECT
    `ID`,
    `job_number`,
    `container_type`,
    `single_cnt`,
    `soc`,
    `ow`,
    `cy`,
    `rtn`,
    `container_number`,
    `seal_number`,
    `pcs`,
    `package`,
    `gross_weight`,
    `cbm`,
    `ref_job_id`
FROM
    `container`
WHERE
    ref_job_id = '$data_id'
";

$result = $con->query($job_title_data);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $job_title = $row;
  }
} else {
  $job_title = "0 results";
}

$result = $con->query($container_information_data);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $container_information = $row;
  }
} else {
  $container_information = "0 results";
}

$result = $con->query($container_data);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $container[] = $row;
  }
} else {
  $container = "0 results";
}

echo json_encode(array('job_title'=>$job_title,'container_information'=>$container_information,'container'=>$container));
?>