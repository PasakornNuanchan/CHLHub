<?php
include '../../core/conn.php';

$sql = "
SELECT
    `ID`,
    `consignee_name`
FROM
    `consignee`
";

$result = $con -> query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $consignee[] = $row;
    }
} else {
    $consignee[] = "0 results";
}

echo json_encode(array('consignee'=>$consignee))

?>