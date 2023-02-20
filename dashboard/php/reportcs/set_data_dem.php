<?php
$job_number = $_POST['job_number'];
    include '../../core/conn.php';

      $sql_dem = "
      SELECT  
        dem.ID,
        dem.container_id,
        dem.old_dem_time,
        dem.new_dem_time,
        dem.file_add,
        c.container_number,
        c.job_number,
        c.ID as head_of_container,
        c.RTN,
        c.CY
      FROM demurrage as dem
        LEFT JOIN container as c ON dem.container_id = c.ID
      WHERE 
        c.job_number = '$job_number' AND status = '0'
      ORDER BY 
        dem.ID ASC
      ";


$result = $con->query($sql_dem);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $dem[] = $row;
  }
} else {
  $dem = "0 results";
}
      

     echo json_encode(array('dem'=>$dem));




?>