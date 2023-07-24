<?php
include '../../core/conn.php';


$id_get = $_POST['id_get'];


$sql_quest_value_get = "
SELECT * FROM `cash_pay` WHERE petty_cash_number = '$id_get'
";

$result = $con->query($sql_quest_value_get);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $petty_cash_val[] = $row;
  }
} else {
  $petty_cash_val = "0 results";
}

echo json_encode(array('petty_cash_val'=>$petty_cash_val));
?>