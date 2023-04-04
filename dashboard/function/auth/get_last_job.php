<?php

$sql_get_last_number = "SELECT jt.job_number FROM job_title  jt ORDER BY jt.ID DESC LIMIT 1";

$result = $con->query($sql_get_last_number);
if ($result->num_rows > 0) {
    $sgln = $result->fetch_assoc();
} else {
    $sgln = "0 results";
}

$get_job_year = substr($sgln['job_number'], 0, 4);
$get_job_month = substr($sgln['job_number'], 4, 2);
$get_job_num = substr($sgln['job_number'], 6, 4);

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
?>
