<?php
    $emi = ($_SESSION['name']);
    $sql_user_query = "
    SELECT ID,user_number,bank_number,bank_name,department_number FROM user WHERE first_name = '$emi'";

    $result = $con->query($sql_user_query);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $user_number = $row;
      }
    } else {
      $user_number = "0 results";
    }

    json_encode(array('user_number'=>$user_number));
    $data_user = $user_number['ID'];
    $data_user_id = $user_number['user_number'];
    $data_bank_number =$user_number['bank_number'];
    $data_bank_name =$user_number['bank_name'];
    $department_number =$user_number['department_number'];
    
    
    date_default_timezone_set("Asia/Bangkok");

 $t_time = (date("Y-m-d H:i:sa"));
 $t_time_save =substr($t_time,0,19);
 $t_time_date =substr($t_time,0,10)
?>