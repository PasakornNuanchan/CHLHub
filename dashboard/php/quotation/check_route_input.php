<?php
   include '../../core/conn.php';
   $carrier = $_POST['carrier'];
   $carrier_type = $_POST['carrier_type'];
   $pol = $_POST['pol'];
   $pod = $_POST['pod'];
   $arr = array();
   $sql = "
   SELECT * FROM `route`
    WHERE 1
    AND `carrier_number` = '$carrier' 
    AND `container_type` = '$carrier_type'
    AND `pol` = '$pol'
    AND `pod` = '$pod'
    LIMIT 1
   ";
   
   $result = $con -> query($sql);

   if ($result->num_rows > 0) {
       while($row = $result->fetch_assoc()) {
           $arr[] = $row;
       }
   } else {
       $arr[] = "0 results";
   }
   echo json_encode($arr)
?>