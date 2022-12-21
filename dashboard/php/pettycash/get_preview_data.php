<?php
$petty_number = $_POST['petty_cash_number'];
    include '../../core/conn.php';


    $bk_no = $_POST['petty_cash_number'];
    $sql = "
    SELECT * FROM `petty_cash_title` as pct
    INNER JOIN user as u ON pct.request_by = u.user_number
    WHERE petty_cash_number = '$petty_number'
    ";


    $sql_continfo = "
    SELECT * FROM `petty_cash_detail` where `petty_cash_number` ='$petty_number'
    ";
    $result = $con -> query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo json_encode($row);
        }
      } else {
        echo "0 results";
      }
?>