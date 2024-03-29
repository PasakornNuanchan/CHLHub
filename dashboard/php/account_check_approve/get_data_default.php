<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';


$sql_data_default = "
SELECT
    'AP' AS name_type,
    1 AS TYPE,
    `ID`,
    `name` AS NAME
FROM
    `Goverment_contact`
UNION
SELECT
    'AP' AS name_type,
    2 AS TYPE,
    `ID`,
    `carrier_name` AS NAME
FROM
    carrier
UNION
SELECT
    'AR' AS name_type,
    1 AS TYPE,
    `ID`,
    `consignee_name` AS NAME
FROM
    consignee
";


$sql_data_job_number = "
SELECT
    jt.job_number
FROM
    `billing` b
    LEFT JOIN job_title jt ON b.ref_job_id = jt.ID
GROUP BY
	jt.job_number

";

$sql_data_description = "
SELECT
	bd.ID,
    bd.billing_code
FROM
    `billing` b
    LEFT JOIN billing_description bd ON b.billing_description = bd.ID
GROUP BY
	bd.ID
";

$sql_data_user_serach = "
SELECT
	u.ID,
  u.first_name,
  u.last_name
FROM
    `user` u
ORDER BY
	u.first_name ASC
";


$result = $con->query($sql_data_user_serach);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $user_search[] = $row;
    }
  } else {
    $user_search = "0 results";
  }

$result = $con->query($sql_data_default);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $default[] = $row;
    }
  } else {
    $default = "0 results";
  }

  $result = $con->query($sql_data_job_number);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $job_number[] = $row;
    }
  } else {
    $job_number = "0 results";
  }

  $result = $con->query($sql_data_description);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $description[] = $row;
    }
  } else {
    $description = "0 results";
  }


  echo json_encode(array('default'=>$default,'job_number'=>$job_number,'description'=>$description,'user_search'=>$user_search));
