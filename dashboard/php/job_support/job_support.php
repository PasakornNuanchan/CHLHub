<?php

require '../../core/conn.php';
require '../../function/auth/get_session.php';
include '../../core/con_path.php';
include '../../function/auth/get_last_job.php';


$sql_job_title = "
INSERT INTO `job_title`(
    `create_date`,
    `status_job`
)
VALUES(
    '$t_time_save',
    '0'
)
";

$result_title = $con->query($sql_job_title);

$sql_get_last_number = "SELECT jt.ID FROM job_title  jt ORDER BY jt.ID DESC LIMIT 1";

$result = $con->query($sql_get_last_number);
   if ($result->num_rows > 0) {
     while ($row = $result->fetch_assoc()) {
       $route_set = $row['ID'];
     }
   } else {
     $route_set = "0 results";
   }


$sql_job_detail = "
INSERT INTO `job_status`(
    `ref_job_id`
)
VALUES(
    '$route_set'
)
";
$result_detail = $con->query($sql_job_detail);




$sql_container_information = "
INSERT INTO `container_information`(
    `ref_job_id`
)
VALUES(  
    '$route_set'
)";


$result_detail = $con->query($sql_container_information);

