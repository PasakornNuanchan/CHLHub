<?php

//Set the session timeout for 1800 seconds
$timeout = 1800;

//Set the maxlifetime of the session
ini_set( "session.gc_maxlifetime", $timeout );

//Set the cookie lifetime of the session
ini_set( "session.cookie_lifetime", $timeout );

//Start a new session
session_start();

//Set the default session name
$s_name = session_name();

//Check the session exists or not
if(isset( $_COOKIE[ $s_name ] )) {
    setcookie( $s_name, $_COOKIE[ $s_name ], time() + $timeout, '/' );
    //echo "Session is created for $s_name.<br/>";
} else {
    ?>
    <script>
        alert('SESSION TIMED OUT!! Please login again.');
        window.location = 'auth/sign-in.php';
    </script>
    <?php
    // echo "Session is expired.<br/>";
    // echo ('<script> alert("Your session destroyed"); </script>');
    // header('Location: '.'auth/sign-in.php');
}
?>