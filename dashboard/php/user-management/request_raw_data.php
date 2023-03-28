<?php
    include '../../core/conn.php';

    $user_number = $_POST['user_number'];

    $sql_request_raw_user = "
    SELECT * FROM user WHERE ID = $user_number";

    $result = $con -> query($sql_request_raw_user);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $sqru = $row;
        }
      } else {
        $sqru = "0 results";
      }


      echo json_encode(array('sqru'=>$sqru));
?>