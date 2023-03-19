<?php
require '../../core/conn.php';
require '../../function/auth/get_session.php';
require '../../core/con_path.php';
$file = $_POST['file_64'];
$type = $_POST['type'];
$job_no = $_POST['job_no'];

switch ($type){
    case 'inv':
        $field_name = 'INV_picture';
        $receiv = 'INV_receiv_by';
        $datetime = 'inv_receiv_datetime';
        break;
    case 'pl':
        $field_name = 'PL_picture';
        $receiv = 'PL_receiv_by';
        $datetime = 'pl_receiv_datetime';
        break;
    case 'bl':
        $field_name = 'BL_picture';
        $receiv = 'BL_receiv_by';
        $datetime = 'bl_receiv_datetime';
        break;
    case 'id':
        $field_name = 'ID_picture';
        $receiv = 'ID_receiv_by';
        $datetime = 'id_receiv_datetime';
        break; 
    case 'il':
        $field_name = 'IL_picture';
        $receiv = 'IL_receiv_by';
        $datetime = 'il_receiv_datetime';
        break;
}



$con->query("SET GLOBAL max_allowed_packet=67108864");
$sql = "
UPDATE job_status set 
    `$field_name` = ?,
    `$receiv` = '$data_user',
    `$datetime` = '$t_time_save'
WHERE 1 
    AND job_number = ?
";

$stmt = $con->prepare($sql);
$stmt->bind_param("ss" ,$file,$job_no);
if ($stmt->execute()) {
    // Success! Handle the results here
    echo json_encode(array('st' => '1'));
} else {
    // Error executing the statement. Handle the error here
    $error = $stmt->errorInfo();
    // $error contains an array with error details
    // $error[0] contains the SQLSTATE error code
    // $error[1] contains the driver-specific error code
    // $error[2] contains the error message
    echo json_encode(array('st' => '0'));
    echo "Error executing statement: " . $error[2];
}

?>