<?php
    include '../../core/conn.php';

    $data_department = $_POST['data_department'];

    $sql_request_raw_department = "
       SELECT menu FROM department WHERE ID = $data_department";

    $result = $con->query($sql_request_raw_department);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $srrd = $row['menu'];
      }
    } else {
      $srrd = "0 results";
    }

    $srrdl = explode(",",$srrd);

    // $sql_request_menu = "
    // SELECT link FROM menu WHERE ID IN ($srrd)
    // ";

    // $result = $con->query($sql_request_menu);
    // if ($result->num_rows > 0) {
    //   while ($row = $result->fetch_assoc()) {
    //     $srrdl[] = $row;
    //   }
    // } else {
    //   $srrdl = "0 results";
    // }

    

      echo json_encode(array('srrdl'=>$srrdl));
?>