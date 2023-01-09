<?php
    include '../../core/conn.php';
    $arr = array();
    $carrier_no = $_POST['carrier_no'];
    $sql = "
    SELECT DISTINCT
        `pol`,
        `pod`,
        `container_type`
    FROM
        `route`
    WHERE
        `carrier_number` = '$carrier_no'
    ";
    
    $result = $con -> query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $arr[] = $row;
        }
    } else {
        $arr[] = "0 results";
    }
    echo json_encode($arr)
?>