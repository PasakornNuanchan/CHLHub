<?php
  include '../../core/conn.php';
  require '../../function/auth/get_session.php';
  include '../../core/con_path.php';
  $job_number = $_POST['job_number'];


  $sql_checkdoc = "
    UPDATE
      `job_title`
    SET
      `check_document` = '$t_time_save'
    WHERE
      job_number ='$job_number' ";
    
    
     
     $status = $con->query($sql_checkdoc);

    echo json_encode($status);


  
?>