<?php
include '../../core/conn.php';

$sql_query_header = "
SELECT
    *
FROM
    `corp_header_bill`
WHERE
    1
";

$result = $con->query($sql_query_header);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $data_header[] = $row;
    
  }
} else {
  $data_header = "0 results";
}

$sql_query_footer = "
SELECT
    *
FROM
    `corp_footer_bill`
WHERE
    1
";


$result = $con->query($sql_query_footer);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $data_footer[] = $row;
  }
} else {
  $data_footer = "0 results";
}





echo json_encode(array('data_header'=>$data_header,'data_footer'=>$data_footer))
?>