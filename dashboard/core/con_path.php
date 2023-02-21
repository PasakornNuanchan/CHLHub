<?php
    $emi = ($_SESSION['email']);
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
    
    date_default_timezone_set("Asia/Bangkok");

 $t_time = (date("Y-m-d H:i:sa"));
 $t_time_save =substr($t_time,0,19);

?>