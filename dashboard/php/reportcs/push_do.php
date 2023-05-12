<?php
  include '../../core/conn.php';
  require '../../function/auth/get_session.php';
  include '../../core/con_path.php';
  $job_number = $_POST['job_number'];


  $sql_do = "
    UPDATE
      `job_title`
    SET
      `pickup_DO_date` = '$t_time_save'
    WHERE
      ID ='$job_number' ";
    
    
     
     $status = $con->query($sql_do);

    echo json_encode($status);


  
?>