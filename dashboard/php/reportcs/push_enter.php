<?php
  include '../../core/conn.php';
  require '../../function/auth/get_session.php';
  include '../../core/con_path.php';
  $job_number = $_POST['job_number'];


  $sql_enter = "
    UPDATE
      `job_title`
    SET
      `enter_date` = '$t_time_save'
    WHERE
      ID ='$job_number' ";

    
     
     $status = $con->query($sql_enter);

    echo json_encode($status);


  
?>