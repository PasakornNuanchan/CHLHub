<?php

include '../../core/conn.php';

//Set the session timeout for 1800 seconds
$timeout = 7200;

//Set the maxlifetime of the session
ini_set("session.gc_maxlifetime", $timeout);

//Set the cookie lifetime of the session
ini_set("session.cookie_lifetime", $timeout);


$user = $_POST['user'];
$pass = $_POST['pass'];

// ตรวจสอบว่า $con ถูกต้องหรือไม่
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
$key = "LHC2zMKN1!?a83b7@a3Hl9#SnaKA0923";
$iterations = 9137;
$pwHash = hash_pbkdf2('sha256', $pass, $key,$iterations,32);
$stmt = $con->prepare("SELECT *, USER.user_number as 'user_ses_id'
                      FROM user
                      LEFT JOIN department ON department.department_number = user.department_number
                      WHERE sec_user_id = ? AND sec_user_pass = ? AND status_user = '1'");

$stmt->bind_param("ss", $user, $pwHash);

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo 'No results';
} else {
    while ($row = $result->fetch_assoc()) {
        session_start();
        $_SESSION['ID'] = $row['user_ses_id'];
        $_SESSION['name'] = $row['first_name'];
        $_SESSION['lastname'] = $row['last_name'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['department_name'] = $row['department_name'];
        $_SESSION['Session_start'] = time();
        $_SESSION['Session_exp'] = $_SESSION['Session_start'] + (60 * 30);
    }
    
}

echo json_encode($_SESSION);
