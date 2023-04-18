<?php
require '../../core/conn.php';
require '../../function/auth/get_session.php';
include '../../core/con_path.php';
include '../../function/auth/get_last_job.php';


echo $sql_job_title = "
INSERT INTO `job_title`(
    `job_number`,
    `create_date`,
    `status_job`
)
VALUES(
    '$get_last_job',
    '$t_time_save',
    '0'
)
";

$result_title = $con->query($sql_job_title);
echo $result_title;



echo $sql_job_detail = "
INSERT INTO `job_status`(
    `job_number`
)
VALUES(
    '$get_last_job'
)
";
$result_detail = $con->query($sql_job_detail);
echo $result_detail;



echo $sql_container_information = "
INSERT INTO `container_information`(
    `job_number`
)
VALUES(  
    '$get_last_job'
)";


$result_detail = $con->query($sql_container_information);
echo $sql_container_information;
