<?php

    include '../../core/conn.php';

    //Set the session timeout for 1800 seconds
    $timeout = 1800;

    //Set the maxlifetime of the session
    ini_set( "session.gc_maxlifetime", $timeout );

    //Set the cookie lifetime of the session
    ini_set( "session.cookie_lifetime", $timeout );

    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $query = "
    SELECT
        *,
        USER.user_number as 'user_ses_id'
    FROM USER
        LEFT JOIN department ON department.department_number = USER.department_number
    where sec_user_id = '$user' and sec_user_pass = '$pass'" ;
    // $query = "SELECT * FROM user where 1" ;

    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    if($result->num_rows === 0)
    {
        echo 'No results';
    }else{
        while ($row = mysqli_fetch_array($result)) {
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
    


?>