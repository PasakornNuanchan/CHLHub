<?php
require '../../core/conn.php';
require '../../function/auth/get_session.php';

$type = $_POST['type'];
$job_no = $_POST['job_no'];

switch ($type){
    case 'inv':
        $field_name = 'INV_picture';
        break;
    case 'pl':
        $field_name = 'PL_picture';
        break;
    case 'bl':
        $field_name = 'BL_picture';
        break;
    case 'id':
        $field_name = 'ID_picture';
        break; 
    case 'il':
        $field_name = 'IL_picture';
        break;
}
$result = $con->query("SELECT `$field_name` FROM `job_status` WHERE 1 AND job_number = $job_no;");
while ($row = $result->fetch_array()) {

    $test = $row[0];
}
echo json_encode($test);


?>