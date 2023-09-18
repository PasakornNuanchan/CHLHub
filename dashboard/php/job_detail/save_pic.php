<?php
// include '../../core/conn.php';
// require '../../function/auth/get_session.php';
// require '../../core/con_path.php';

$targetDir = "Applications/xampp/htdocs/chlhub/";
$allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];

//print_r($_FILES);
$targetFile = $targetDir . basename($_FILES["myFile"]["name"]);
$allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
//echo $targetFile;
if (move_uploaded_file($_FILES["myFile"]["tmp_name"], $targetFile)){
    echo "File is uploaded.";
} else {
    echo "File is not uploaded.";
}


    



// if (in_array($_FILES["myFile"]["type"], $allowedTypes)) {
//     // บันทึก path ไฟล์ในฐานข้อมูล
//     $filePath = $targetFile;
    
//     // $sql = "
//     //     UPDATE
//     //     `job_status`
//     // SET
//     //     `INV_picture` = '$filePath'
//     // WHERE
//     //     ref_job_id = '59'
//     // ";

//     // if ($conn->query($sql) === TRUE) {
//     //     echo "File uploaded and database updated successfully.";
//     // } else {
//     //     echo "Error updating database: " . $conn->error;
//     // }
// } else {
//     echo "Error uploading file. Please try again.";
//}
?>
