<?php
  include '../../core/conn.php';
  require '../../function/auth/get_session.php';
  include '../../core/con_path.php';
  $job_number = $_POST['job_number'];
  $shipping_number = $_POST['shipping_number'];


  $sql_ast = "
  UPDATE
    `job_title`
  SET
    `shipping_ass` = '$shipping_number'
  WHERE
    ID = '$job_number' ";
    
    
     
     $status = $con->query($sql_ast);

    echo json_encode($status);


  
?>