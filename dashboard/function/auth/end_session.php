<?php

session_start(); // เริ่มต้นเซสชัน


session_destroy();

if(isset($_SESSION['Session_start'])) {
    setcookie(session_name(), '', time()-10000, '/');
}

// ตั้งค่า session name เป็นค่าว่างเพื่อป้องกันการสร้างเซสชันใหม่ทันที
// session_name('');

?>