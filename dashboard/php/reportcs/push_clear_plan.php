<?php
  include '../../core/conn.php';
  require '../../function/auth/get_session.php';
  include '../../core/con_path.php';
  $job_number = $_POST['job_number'];
  $clearance_plan = $_POST['clearance_plan'];


  $sql_cp = "
  UPDATE
    `job_title`
  SET
    `clearlance_date` = '$clearance_plan'
  WHERE
    job_number = '$job_number' ";
    
    
     
     $status = $con->query($sql_cp);

    echo json_encode($status);


  
?>