<?php
require '../../core/conn.php';
require '../../function/auth/get_session.php';
include '../../core/con_path.php';

$sql_get_last_number = "SELECT MAX(jt.job_number)as last_job FROM job_title jt";

$result = $con->query($sql_get_last_number);
if ($result->num_rows > 0) {
    $sgln = $result->fetch_assoc();
} else {
    $sgln = "0 results";
}



$get_job_year = substr($sgln['last_job'], 0, 4);
$get_job_month = substr($sgln['last_job'], 4, 2);
$get_job_num = substr($sgln['last_job'], 6, 4);

$get_job_num1 = (int)substr($get_job_num,0,1);
$get_job_num2 = (int)substr($get_job_num,1,1);
$get_job_num3 = (int)substr($get_job_num,2,1);
$get_job_num4 = (int)substr($get_job_num,3,1);

$t_time_year = substr($t_time_save, 0, 4);
$t_time_month = substr($t_time_save, 5, 2);

if($get_job_year == $t_time_year){
    if($get_job_month == $t_time_month){
        if($get_job_num4 == 9){
            $get_job_num4 = 0;
            if($get_job_num3 == 9 ){
                $get_job_num3 = 0;
                if($get_job_num2 == 9){
                    $get_job_num2 = 0;
                    $get_job_num1 = $get_job_num1+1;
                }else{
                    $get_job_num2 = $get_job_num2+1;
                }
            }else{
                $get_job_num3 = $get_job_num3+1;
            }
            $res = $get_job_year.$get_job_month.$get_job_num1 . $get_job_num2 . $get_job_num3 . $get_job_num4;    
        }else{
            $get_job_num4 = $get_job_num4+1;
            $res = $get_job_year.$get_job_month.$get_job_num1 . $get_job_num2 . $get_job_num3 . $get_job_num4;    

        }
        $res = $get_job_year.$get_job_month.$get_job_num1 . $get_job_num2 . $get_job_num3 . $get_job_num4;    
    }else{
        $res = $get_job_year.$t_time_month."0001";
    }
}else{
    $res = $t_time_year.$t_time_month."0001";
}

    $get_last_job = $res;
echo json_encode($get_last_job);
