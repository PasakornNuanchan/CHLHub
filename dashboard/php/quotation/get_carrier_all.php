<?php
    include '../../core/conn.php';
    $arr = array();
    $sql = "
        SELECT
            *
        FROM
            `carrier`
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