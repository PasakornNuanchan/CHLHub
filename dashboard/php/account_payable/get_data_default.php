<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';

$sql_get_bill_to = "
SELECT
    1 AS TYPE,
    `ID`,
    `name` AS NAME
FROM
    `Goverment_contact`
UNION
SELECT
    2 AS TYPE,
    `ID`,
    `carrier_name` AS NAME
FROM
    carrier
";

$sql_get_job_number = "
SELECT
    ID,
    job_number
FROM
    job_title    
WHERE
	job_number is not null AND job_number !=''
GROUP BY
	job_number
ORDER BY
	job_number asc";

$sql_get_hbl = "
SELECT
    ID,
    hbl
FROM
    bl_title
WHERE
	hbl is NOT null AND hbl != ''
GROUP BY
	HBL";

$sql_get_container = "
SELECT
    ID,
    container_number
FROM
    container
WHERE
    container_number IS NOT NULL AND container_number != ''
GROUP BY
    container_number
ORDER BY
    ID ASC
";

$sql_billing_code = "
SELECT ID,billing_item_name FROM billing_description";

$sql_get_user = "
SELECT ID,first_name,last_name FROM user";

$result = $con->query($sql_get_user);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $user_data_default[] = $row;
  }
} else {
  $user_data_default = "0 results";
}
$result = $con->query($sql_billing_code);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $billing_code[] = $row;
  }
} else {
  $billing_code = "0 results";
}

$result = $con->query($sql_get_container);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $container[] = $row;
  }
} else {
  $container = "0 results";
}

$result = $con->query($sql_get_hbl);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $hbl[] = $row;
  }
  $hbl = array_filter($hbl);
} else {
  $hbl = "0 results";
}






$result = $con->query($sql_get_job_number);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $job_number[] = $row;
  }
} else {
  $job_number = "0 results";
}

$result = $con->query($sql_get_bill_to);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $bill_to_ap[] = $row;
  }
} else {
  $bill_to_ap = "0 results";
}



echo json_encode(array('bill_to_ap'=>$bill_to_ap,'job_number'=>$job_number,'hbl'=>$hbl,'container'=>$container,'billing_code'=>$billing_code,'user'=>$user_data_default))

?>



