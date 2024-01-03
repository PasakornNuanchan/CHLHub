<?php 
include '../../core/conn.php';

$name = $_POST['name'];

$sql = "
SELECT
    `ID`
FROM
    `consignee`
WHERE
    consignee_name = '$name'
";

$result = $con->query($sql);
    if ($result->num_rows > 0) {
        $data_check = "1";
    } else {
      $data_check = "0";
    }


echo json_encode($data_check);
?>