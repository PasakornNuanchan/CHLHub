<?php
    include '../../core/conn.php';
    require '../../function/auth/get_session.php';
    include '../../core/con_path.php';

    $t_time_date = '2022-11-15';

    
   $sql_route = "
    SELECT
        *
    FROM
        `route`
    WHERE '$t_time_date' BETWEEN start_date AND end_date
   ";

   $result = $con->query($sql_route);
   if ($result->num_rows > 0) {
     while ($row = $result->fetch_assoc()) {
       $route_set[] = $row;
     }
   } else {
     $route_set = "0 results";
   }
   
    echo json_encode(array('route_set'=>$route_set));

?>