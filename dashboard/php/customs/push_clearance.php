<?php
  include '../../core/conn.php';
  require '../../function/auth/get_session.php';
  include '../../core/con_path.php';
 
 $job_number = $_POST['job_number'];

    $sql_inv_query = "
    UPDATE `job_status` SET 
    `Cus_by` = '$data_user', 
    `Cus_suc_datetime` = '$t_time_save', 
    `Cus_status` = '1' 
    WHERE job_number = '$job_number';";
    
    
     
    $status = $con->query($sql_inv_query);

    echo json_encode($status);


  
?>