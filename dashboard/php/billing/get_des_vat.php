<?php
    include '../../core/conn.php';
    $des_number = $_POST['des_number'];
    
    
   $sql_vat = "
    SELECT vat FROM billing_description WHERE ID = '$des_number'
    ";
      $result = $con -> query($sql_vat);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $vat = $row['vat'];
        }
      } else {
        $vat = "0 results";
      }
      echo json_encode(array('vat'=>$vat));
