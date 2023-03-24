<?php
    require '../../core/conn.php';
    require '../../function/auth/get_session.php';
    require '../../core/con_path.php';


    $sql_depart = "
    SELECT * FROM department as d
    WHERE d.ID = '$department_number'
    ";

    $result = $con -> query($sql_depart);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $menu_row = $row['menu'];
        }
    } else {
        $menu_row = "0 results";
    }
    
    //$department_number;
    $sql_quotation = "
    SELECT * FROM menu WHERE ID IN ($menu_row)
ORDER BY menu_number ASC
    ";
    
    $sql_data_check = "
    SELECT link FROM `menu` WHERE ID IN ($menu_row) UNION SELECT link FROM sub_menu WHERE main_menu IN ($menu_row) ORDER BY `link` ASC
    ";

    $result = $con -> query($sql_quotation);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $menu_list_main[] = $row;
            $menu_list[] = $row['menu_name'];
        }
    } else {
        $menu_list = "0 results";
    }

    foreach ($menu_list_main as $k => $v) {
        $menu_list_main_arr[$v['menu_name']][] = $v;
      }
      
    
      $result = $con -> query($sql_data_check);

      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
              $link_check[] = $row;
          }
      } else {
          $link_check = "0 results";
      }
  
     
      
    echo json_encode(array('menu_list_main'=>$menu_list_main_arr,'link_check'=>$link_check));

?>