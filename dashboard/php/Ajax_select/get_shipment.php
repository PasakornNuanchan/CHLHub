<?php
    include '../../core/conn.php';
    $arr = array();
    $sql = "
    SELECT
        `ID`,
        `st_number`,
        `st_name`
    FROM
        `shipment_term`
    WHERE
        1
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