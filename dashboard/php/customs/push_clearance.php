<?php
  require '../../function/auth/get_session.php';
 
 $job_number = $_POST['job_number'];

 $emi = ($_SESSION['email']);
 //$emi = "art@mail.com";
 date_default_timezone_set("Asia/Bangkok");
 //echo $t = time();
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
    UPDATE `job_status` SET 
    `Cus_by` = '$data_user', 
    `Cus_suc_datetime` = '$t_time_save', 
    `Cus_status` = '1' 
    WHERE job_number = '$job_number';";
    
    
     
    $status = $con->query($sql_inv_query);

    echo json_encode($status);


  
?>