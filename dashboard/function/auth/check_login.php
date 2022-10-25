<?php

    include '../../core/conn.php';
    session_start();
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $query = "SELECT * FROM user left join department on department.department_number = user.department_number where sec_user_id = '$user' and sec_user_pass = '$pass'" ;
    // $query = "SELECT * FROM user where 1" ;

    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    if($result->num_rows === 0)
    {
        echo 'No results';
    }else{
        while ($row = mysqli_fetch_array($result)) {
            $_SESSION['name'] = $row['first_name'];
            $_SESSION['lastname'] = $row['last_name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['department_name'] = $row['department_name'];

        }
    }
    echo json_encode($_SESSION);
    


?>