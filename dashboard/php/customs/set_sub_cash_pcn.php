<?php
$job_number = $_POST['job_number'];
    include '../../core/conn.php';


$sql_sel_pcn = "
SELECT
    ID,
    petty_cash_number
FROM
    `petty_cash_detail`
WHERE
    job_number = '$job_number'
    ";

$result = $con->query($sql_sel_pcn);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $pcn[] = $row;
  }
} else {
  $pcn = "0 results";
}




     echo json_encode(array('pcn'=>$pcn));
?>