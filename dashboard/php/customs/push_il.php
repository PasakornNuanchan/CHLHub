<?php
  require '../../function/auth/get_session.php';
 
 $job_number = $_POST['job_number'];

 $emi = ($_SESSION['email']);
 date_default_timezone_set("Asia/Bangkok");
 $t_time = (date("Y-m-d H:i:sa"));
 $t_time_save =substr($t_time,0,19);

 
 
 
 // echo $t_time;
    include '../../core/conn.php';


    $sql_user_query = "
    SELECT user_number FROM user WHERE email = '$emi'";

    $result = $con->query($sql_user_query);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $user_number = $row;
      }
    } else {
      $user_number = "0 results";
    }

    json_encode(array('user_number'=>$user_number));
    $data_user =$user_number['user_number'];

    $sql_inv_query = "
    UPDATE `job_status` SET `IL_check_by` = '$data_user', `il_check_datetime` = '$t_time_save' WHERE job_number = '$job_number';";
    
    
     
    $status = $con->query($sql_inv_query);

    echo json_encode($status);


  
?>