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
    `port_of_discharge`,
    `port_of_delivery_number`,
    `mother_vessel`,
    `feeder_vessel`,
    `etd`,
    `eta`,
    `remark`,
    `booking_agent`,
    `sale_support`,
    `cs_support`,
    `commodity`,
    `delivery_place`,
    `notify_type`,
    `notify_number`,
    `client_type`,
    `client_number`
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
    `gw`,
    `remark`,
    `package`,
    `volume`,
    `container_number`,
    `seal_number`,
    `pcs`,
    `cargo_description`,
    `package`,
    `gross_weight`,
    `cbm`,
    `ref_job_id`,
    `unit`
FROM
    `container`
WHERE
    ref_job_id = '$data_id'
";

$container_query= "
SELECT
    container_type,
    COUNT(ID) count_data_row
FROM
    `container`
WHERE
    ref_job_id = '$data_id'
    GROUP BY container_type
";

$get_hbl_query = "
SELECT ID,hbl FROM bl_title WHERE ref_job_id = '$data_id'
";

$result = $con->query($get_hbl_query);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $hbl_data[] = $row;
  }
} else {
  $hbl_data = "0 results";
}

$result = $con->query($container_query);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $data_container[] = $row;
  }
} else {
  $data_container = "0 results";
}

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

echo json_encode(array('job_title'=>$job_title,'container_information'=>$container_information,'container'=>$container,'data_container'=>$data_container,'hbl_data'=>$hbl_data));
?>