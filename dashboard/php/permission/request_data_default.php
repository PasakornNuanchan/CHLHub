<?php
    include '../../core/conn.php';

    $sql_request_department = "
    SELECT ID,department_name FROM `department`";


    $sql_request_menu = "
    SELECT ID,menu_number,menu_name,menu_icon,link FROM `menu` ORDER BY menu_number
    ";


    $sql_request_job_detail = "
    SELECT
      pjd.ID,
      pjd.department,
      d.department_name,
      pjd.job_detail,
      pjd.transport,
      pjd.reportcs,
      pjd.customs,
      pjd.billing,
      pjd.withdraw

  FROM
      `permisson_job_detail` pjd
      LEFT JOIN department d ON d.ID = pjd.department
    ";
    $sql_request_cash = "
    SELECT
      pc.ID,
      pc.department,
      d.department_name,
      pc.payble,
      pc.advance,
      pc.pettycash,
      pc.returnpettycash
    FROM
        `permission_cash` pc
        LEFT JOIN department d ON d.ID = pc.department
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

      $result = $con -> query($sql_request_job_detail);
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $rjd[] = $row;
        }
      } else {
        $rjd = "0 results";
      }

      $result = $con -> query($sql_request_cash);
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $rc[] = $row;
        }
      } else {
        $rc = "0 results";
      }


      echo json_encode(array('srd'=>$srd,'menu_select'=>$menu_select,'rjd'=>$rjd,'rc'=>$rc));
