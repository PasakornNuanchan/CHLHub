<?php
include '../../core/conn.php';

$data = $_POST['data'];

$sql_get_petty_cash = "
SELECT * FROM `petty_cash_detail` 
WHERE job_number = '$data'
";

$result = $con->query($sql_get_petty_cash);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $petty_cash_data[] = $row;
  }
} else {
  $petty_cash_data = "0 results";
}

echo json_encode(array('petty_cash_data'=>$petty_cash_data));

?>