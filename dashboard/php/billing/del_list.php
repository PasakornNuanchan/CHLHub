<?php
  require '../../function/auth/get_session.php';
 
$del_id = $_POST['id_des'];

 $emi = ($_SESSION['email']);
 //$emi = "art@mail.com";
 date_default_timezone_set("Asia/Bangkok");
 //echo $t = time();
 $t_time = (date("Y-m-d H:i:sa"));
 $t_time_save =substr($t_time,0,19);

 
 
     include '../../core/conn.php';

     $sql_del_list = "
     UPDATE
     `billing`
  SET
     `status` = '1'
 WHERE
     ID = '$del_id'";
     
    
     
     $status = $con->query($sql_del_list);

     echo json_encode($status);


  
?>