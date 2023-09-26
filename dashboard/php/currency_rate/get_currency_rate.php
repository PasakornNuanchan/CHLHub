<?php
include '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';

$sql_data_require = "
SELECT
    src.ID,
    src.start_date,
    src.end_date,
    src.create_by,
    src.create_datetime,
    src.usd_thb,
    src.usd_rmb,
    src.usd_yen,
    src.thb_usd,
    src.thb_rmb,
    src.thb_yen,
    src.rmb_usd,
    src.rmb_thb,
    src.rmb_yen,
    src.yen_usd,
    src.yen_thb,
    src.yen_rmb,
    u1.first_name,
    u1.last_name
FROM
    sys_rate_cur src
LEFT JOIN user u1 ON src.create_by = u1.ID
ORDER BY
    src.ID DESC
LIMIT 100;

    

";

$result = $con->query($sql_data_require);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $require[] = $row;
  }
} else {
  $require = "0 results";
}

echo json_encode(array('require'=>$require));

?>