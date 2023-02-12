<?php
 include '../../core/conn.php';
 $arr = array();

 $val = $_POST['val'];
 
 $sql = "
 SELECT seal_number FROM container WHERE ID = '$val';";

 $result = $con -> query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $arr = $row;
        }
    } else {
        $arr = "0 results";
    }
    echo json_encode($arr)
?>