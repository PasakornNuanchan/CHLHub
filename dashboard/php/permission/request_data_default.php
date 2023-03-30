<?php
    include '../../core/conn.php';

    $sql_request_department = "
    SELECT ID,department_name FROM `department`";


    $sql_request_menu = "
    SELECT ID,menu_number,menu_name,link FROM `menu` ORDER BY ID
    ";

    $result = $con -> query($sql_request_department);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $srd[] = $row;
        }
      } else {
        $srd = "0 results";
      }

      $result = $con -> query($sql_request_menu);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $menu_select[] = $row;
        }
      } else {
        $menu_select = "0 results";
      }


      echo json_encode(array('srd'=>$srd,'menu_select'=>$menu_select));
?>